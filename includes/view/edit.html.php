<? /*
 $data -> id
 $data -> calcname
 $data -> content - компоненты
 $data -> settings - общие настройки
*/
if ($data){
	$settings = $data->settings;
	$contents = $data->content;
	/*print_r_pre($contents);*/
}
?>

<h1 class="text-secondary">Редактировать калькулятор</h1>

<form class="form-change freecalc" method="post" action="">

	<div class="freecalc-header widgets-holder-wrap padding">
		<div class="form-group">
			<input type="hidden" class="page-url" value="<?= $_SERVER['REQUEST_URI'] ?>">
			<input type="hidden" class="page-type" value="edit">
			<input type="text" class="form-control input-middle" name="calc-name" data-id="<?= $data->id ?>" placeholder="Имя калькулятора" value="<?= $data->calcname ?>" required />
		</div>
	</div>

	<!-- Settings calc -->
	<? include FREECALC_INC.'view/partials/calc-settings.php'?>

	<div class="freecalc-body">
		<!-- Сюда добавляются колонки -->
		<div class="container-calc row" id="content-column">
			<?
			if ($contents){
                $count = 1;
				foreach ($contents as $item) {
                    $item['column-id'] = $count;
					echo view2($item['component'],
                      ['compsNext'=>$item['nested'],
                      'comp'=>$item]);

					/*include FREECALC_INC . 'view/components/column.php';*/
                    $count++;
				}
			}
			?>
		</div>
		<!-- /end -->

	</div>

	<div class="freecalc-footer">
		<div class="wrap">
			<!-- Добавить колонку -->
			<button type="button" class="btn btn-light btn-green add-column" title="Добавить колонку">
				<i class="fal fa-plus-square"></i>
			</button>
		</div>


      <!-- Детализация -->
		 <? //include FREECALC_INC.'view/partials/detailing-block.php'?>
      <!-- **** -->

		<div class="wrap">
			<button class="button-primary save-calc" type="submit">Сохранить</button>
		</div>

		<div class="wrap">
			<button class="button-primary save-calc absolute" type="submit">Сохранить</button>
		</div>
	</div>


	<!-- Все компоненты должны лежать в форме, на нее подвешен обработчик -->

	<? include FREECALC_INC.'view/components/index.php'?>

</form>

<div class="settings-detailing">
   <pre>
      <code>
         <p><b>next-check-price</b>: Указать текущей группе, если цену  нужно взять со следующей групы набора инпутов</p>
         <p><b>prev-calc-area</b>: Указать текущей группе, если нужно посичать площадь с вышележащей группы и умножить на текущюю стоимость </p>
        <?
	 /* $mapDetailing */
	 print_r(include FREECALC_INC.'view/partials/detailing-classes.php') ?></code>
   </pre>
</div>
