<?php

class AdminController {
	private $freecalc;
	private static $tableDB = FREECALC_TABLE;

	public function __construct($freecalc = 'freecalc')
	{
		$this->freecalc = $freecalc;
	}

	public function enqueue_styles()
	{
		wp_enqueue_style( $this->freecalc.'-font-awesome',  FREECALC_URL.'admin/plugins/fontawesome-pro-5.15.1-web/css/all.min.css' );
		wp_enqueue_style( $this->freecalc.'-tingle',  FREECALC_URL.'admin/plugins/tingle-master/tingle.min.css' );
		wp_enqueue_style( 'jquery-ui',  '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'trumbowyg',  FREECALC_URL.'plugins/trumbowyg/ui/trumbowyg.min.css' );

		wp_enqueue_style_version($this->freecalc,'admin/css/admin.css');
	}

	public function enqueue_scripts()
	{
		wp_enqueue_script( $this->freecalc.'-tingle',  FREECALC_URL.'admin/plugins/tingle-master/tingle.min.js' );
		wp_enqueue_script( 'draggable-jq',  'https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.11/lib/draggable.bundle.js' );
		wp_enqueue_script( 'sortable-jq',  'https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.11/lib/sortable.js' );
		wp_enqueue_script( 'jquery-ui',  '//code.jquery.com/ui/1.12.1/jquery-ui.js', ['jquery'], '', true );

		wp_enqueue_script('jquery');
		wp_enqueue_script( 'trumbowyg',  FREECALC_URL.'plugins/trumbowyg/trumbowyg.min.js', ['jquery'], '', true );

		wp_enqueue_script_version( $this->freecalc, 'admin/js/main.js', ['jquery'], true);

		wp_localize_script( $this->freecalc, 'wooAjaxScript',
			array(
				'url' => admin_url('admin-ajax.php'),
				//'url' => admin_url() . 'admin.php?page=freecalc-make',
				'nonce' => wp_create_nonce('ajax-nonce')
			)
		);
	}

	/* Ajax */
	public function adminAjax()
	{
		add_action( 'wp_ajax_freecalc_save_calc', [$this, 'saveCalc' ]);

		add_action( 'wp_ajax_freecalc_delete_calc', [$this, 'deleteCalc' ]);
		add_action( 'wp_ajax_freecalc_duplicate_calc', [$this, 'duplicateCalc' ]);
		add_action( 'wp_ajax_freecalc_update_settings', [$this, 'saveSettings' ]);
	}

	/* Получить компоненты калькулятора (файлы) */
	public function getTypeComponents()
	{
		$dir = FREECALC_INC . 'view/components/';
		$components = [];

		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..')
				continue;

			$nameArr = explode('.php', $item);
			$name = $nameArr[0];
			if (count($nameArr)<=1)
				continue;

			if (!$name || $name == 'index' || $name == 'group' || $name == 'column')
				continue;
				$components[]=$name;
		}
		return $components;
	}


	/*-------------------------*/
	// Взаимодействие с записями калькулятора
	/*-------------------------*/
	public function getAllCalc(){
		global $wpdb;
		$table_name = $this->getTableName();

		$results = $wpdb->get_results( "SELECT * FROM {$table_name} ORDER BY id DESC" );

		return $results;
	}

	/* Получить одну запись по ID */
	public function getCalc($id, $is_return_db = false)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . self::$tableDB;
		$data = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE id = $id" );

		if ($is_return_db)
			return $data;

		$data->content = maybe_unserialize($data->content);
		$data->settings = maybe_unserialize($data->settings);
		return $data;
	}

	/* Сохранить калькулятор (если передан id, то обновить существующий) */
	public function saveCalc()
	{
		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('ajax-nonce');
		if($nonce_outside !== $nonce_inside){
			echo 'Not';
			wp_die('','','403');
		}

		$id = $_POST['id'];
		$calcname = htmlspecialchars(trim($_POST['calcname']));
		//$detailing = htmlspecialchars(trim($_POST['detailing']));
		$content = $_POST['contents'];
		$settings = $_POST['settings'];
		$mess = [];

		$data = [
			'calcname'=>$calcname,
			'content'=>$content,
			//'detailing'=>$detailing,
			'settings'=>$settings,
		];

		if (!$calcname){
			$mess['error'] = "ok";
			$mess['messages'][] = "Заголовок не может быть пустым";
		}

		if ($mess['error']==='ok'){
			echo json_encode($mess);
			wp_die();
		}

		if ($id>0){
			$mess = $this->editCalc($id, $data);
		} else{
			$mess = $this->createCalc($data);
		}

		echo json_encode($mess);
		wp_die();
	}

	public function createCalc($data)
	{
		global $wpdb;
		$table = $this->getTableName();
		$arr = [];

		$id = $wpdb->insert(
			$table,
			[
				'calcname' => $data['calcname'],
				'content' => maybe_serialize($data['content']),
				//'detailing' => maybe_serialize($data['detailing']),
				'settings' => maybe_serialize($data['settings']),
			]
			,
			array('%s','%s','%s')
		);

		if($id>0) {
			$mess['messages'][] = "Успешно сохранено";
			$mess['messages']['db'] = $wpdb->insert_id;
		}
		else {
			$mess['error'] = "ok";
			$mess['messages'][] = "Ошибка сохранения";
			$mess['messages']['db'] = $id;
		}
		return $mess;
	}

	public function editCalc($id, $data)
	{
		global $wpdb;
		$table = $this->getTableName();
		$arr = [];

		$id_db = $wpdb->update(
			$table,
			[
				'calcname' => $data['calcname'],
				'content' => maybe_serialize($data['content']),
				//'detailing' => maybe_serialize($data['detailing']),
				'settings' => maybe_serialize($data['settings']),
			]
			,//wp_freecalc_make_settings
			array('id'=> $id)
		);

		if($id_db!==false) {
			$messages['messages'][] = "Успешно обновлено";
			$messages['messages']['db'] = $id_db;
		}
		else {
			$messages['error'] = "ok";
			$messages['messages'][] = "Ошибка обновления";
			$messages['messages']['db'] = $id_db;
		}
		return $messages;
	}

	public function deleteCalc()
	{
		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('ajax-nonce');
		if($nonce_outside !== $nonce_inside){
			echo 'Not';
			wp_die();
		}

		$id = $_POST['id'];
		if(!$id && $id<=0){
			$messages['error'] = "ok";
			$messages['messages'][] = "Не верный ID калькулятора";
			wp_die();
		}
		global $wpdb;
		$table = $this->getTableName();
		$arr = [];

		$db = $wpdb->delete( $table, array( 'id' => $id ) );
		if ($db===1){
			$messages['messages'][] = "Удалено успешно";
			echo json_encode($messages);
			wp_die();
		}
		else{
			$messages['error'] = "ok";
			$messages['messages'][] = "Ничего не удалено";
			echo json_encode($messages);
			wp_die();
		}
	}

	/* Дублировать запись */
	public function duplicateCalc()
	{
		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('ajax-nonce');
		if($nonce_outside !== $nonce_inside){
			echo 'Not';
			wp_die();
		}

		$id = $_POST['id'];
		if(!$id && $id<=0){
			$mess['error'] = "ok";
			$mess['messages'][] = "Не верный ID калькулятора";
			wp_die();
		}
		global $wpdb;
		$table = $this->getTableName();
		$arr = [];

		$post = (array)$this->getCalc($id);
		$post['calcname'] = $post['calcname'] . ' copy';
		$mess = $this->createCalc($post);

		echo json_encode($mess);
		wp_die();
	}


	/*-------------------------*/
	// Настройки калькулятора
	/*-------------------------*/
	public function saveSettings(){
		if( empty($_POST['nonce']) )
			wp_die();
		$nonce_outside = $_POST['nonce'];
		$nonce_inside = wp_create_nonce('ajax-nonce');
		if($nonce_outside !== $nonce_inside){
			echo 'Not';
			wp_die('','','403');
		}
		$mess = [];

		$data = [
			'settings'=>$_POST['settings'],
			'promocode'=>$_POST['promocode'],
		];

		$id_db = $this->updateSettings($data);
		if($id_db!==false) {
			$messages['messages'][] = "Успешно обновлено";
			$messages['messages']['db'] = $id_db;
		}
		else {
			$messages['error'] = "ok";
			$messages['messages'][] = "Ошибка обновления";
			$messages['messages']['db'] = $id_db;
		}
		echo json_encode($messages);
		wp_die();
	}

	public function updateSettings($data, $id = 1){
		// FREECALC_TABLE_SETTING
		global $wpdb;
		$id = 1;
		$table = $wpdb->prefix . FREECALC_TABLE_SETTING;
		$dataSelect = $wpdb->get_row( "SELECT * FROM {$table} WHERE id = $id" );

		// Обновить настройки
		if ($dataSelect)
			$id_db = $wpdb->update(
				$table,
				[
					'promocode' => maybe_serialize($data['promocode']),
					'settings' => maybe_serialize($data['settings']),
				]
				,
				array('id'=> $id)
			);
		else{
			// Создать настройку
			$id_db = $wpdb->insert(
			$table,
			[
				'promocode' => maybe_serialize($data['promocode']),
				'settings' => maybe_serialize($data['settings']),
			]
			,
			array('%s','%s')
		);
		}
		return $id_db;
	}


	public function getSettings($id = 1){
		global $wpdb;
		$table_name = $wpdb->prefix . FREECALC_TABLE_SETTING;

		$data = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE id = $id" );

		$data->promocode = maybe_unserialize($data->promocode);
		$data->settings = maybe_unserialize($data->settings);

		return $data;
	}


	/*-------------------------*/
	//
	/*-------------------------*/
	public function getTableName()
	{
		global $wpdb;
		return $wpdb->prefix . self::$tableDB;
	}

	public function getUpdateBalRate()
	{
		// inc includes/update-curr.php
		$arrBalRate = [
			'balrate_rub'=>'RUB',
			'balrate_usd'=>'USD',
			'balrate_eur'=>'EUR'
		];

		$_curr = [];
		foreach ($arrBalRate as $key => $curr){
			if ($x = inet_request('https://api.cryptonator.com/api/ticker/' . strtolower($curr) . '-rub')){
				if (($a = json_decode($x, 1)) and $a['success'])
				{
					if($a <= 0){
						update_option( $key, '1', false );
						continue;
					}

					$_curr[$key] =  wp_unslash($a['ticker']['price']);
					// обновить курсы валют
					update_option( $key, wp_unslash($a['ticker']['price']), false );
				}
			}
		} // endforeach

	}

}


// добавляем функцию к указанному хуку
//add_action( 'update_bal_curr', 'updateBalrate' );


