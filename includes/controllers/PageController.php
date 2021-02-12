<?php

class PageController{
	private $freecalcName;

	public function __construct($freecalc)
	{
		$this->freecalcName = $freecalc . '-make';
		$this->calculator = new AdminController();
	}


	public function createMenu()
	{
		add_menu_page( 'Калькулятор расчета изделия', 'Free Calc', 'manage_options', $this->freecalcName, [$this, 'index'], 'dashicons-calculator', 80 );

		add_submenu_page(
			$this->freecalcName,
			'Список калькуляторы',
			'Калькуляторы',
			'manage_options',
			$this->freecalcName,
			[$this, 'index']
		);

		add_submenu_page(
			$this->freecalcName,
			'Создать новый калькулятор',
			'Создать новый',
			'manage_options',
			$this->getSlug('create'),
			[$this, 'createCalc']
		);

		add_submenu_page(
			$this->freecalcName,
			'Настройки',
			'Настройки',
			'manage_options',
			$this->getSlug('settings'),
			[$this, 'settingsCalc']
		);

		add_submenu_page(
			$this->freecalcName,
			'Краткая информация по плагину',
			'Инфо',
			'manage_options',
			$this->getSlug('info'),
			[$this, 'infoCalc']
		);

		add_submenu_page(
			$this->freecalcName,
			'Редактировать калькулятор',
			'',
			'manage_options',
			$this->getSlug('edit'),
			[$this, 'editCalc']
		);
	}

	public function index()
	{
		$calcs = new AdminController();
		$data['all'] = $calcs->getAllCalc();

		$data['link_base'] = $this->getSlug();
		$data['link_new'] = $this->getSlug('create');
		$data['link_edit'] = $this->getSlug('edit');

		echo viewComponents('index', ['data'=>$data]);
	}

	public function createCalc()
	{
		$components = [
			'components'=>$this->calculator->getTypeComponents(),
		];
		$components['link_edit'] = $this->getSlug('edit');
		echo viewComponents('add', $components);
	}

	public function editCalc()
	{
		$id = $_GET['id'];
		if (!$id && !($id>0))
			wp_redirect($this->getSlug());

		$components = [
			'components'=>$this->calculator->getTypeComponents(),
			'data'=>$this->calculator->getCalc($id),
		];
		echo viewComponents('edit', $components);
	}

	public function settingsCalc()
	{
		echo viewComponents('settings', []);
	}

	public function infoCalc()
	{
		echo viewComponents('info', []);
	}

	public function getSlug($slug = ''){
		if(!$slug)
			return $this->freecalcName;

		return $this->freecalcName . "-" . $slug;
	}
}