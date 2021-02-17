
<?/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
$is_br = false; ?>

<div class="<?= $classes ?>" <?= $dataset ?> style="<?= $styles ?>" >
   <!-- end div -->

	<? if (is_admin()):
      include FREECALC_INC . 'view/partials/btn-del-elem.php';
	    if ($compSett['connection-name']): ?>
        <div class="emblem"><?= $compSett['connection-name'] ?></div>
        <? endif; ?>

        <!-- $comp - текущий компонент -->
        <!-- $adata - data-attribute.
        Значение дата отрибута, все == значениям data, кроме data-text -->
   <? endif; ?>

	<?= fis_admin('<div class="content row">') ?>
		 <? if ($compsNext){
		     $count = 1;
			 foreach ($compsNext as $item) {
                $item['id'] = $count;
                // Тип инпута, если он в группе
                $item['typeInput'] = $comp['settings']['component-type'];
                $item['column-id'] = $comp['column-id'];
                $item['group-id'] = $comp['group-id'];
                $item['group-block-id'] = $comp['group-block-id'];
                 $item['component-id'] = $count;

				 echo view2($item['component'],
               [
                  'compsNext'=>$item['nested'],
                  'name'=>$item['component'],
                  'comp'=>$item,
                  'adata'=>$item['data'],
                  'group'=>$comp['settings'],
                  'compSett'=>$item['settings'],
               ]);
                 $count++;
			 }
		 } ?>

	<?= fis_admin('</div>') ?>


    <? if (is_admin()): ?>
        <!-- settings -->
        <div class="component-settings delete-save">
          <span class="close">
             <i class="fal fa-times-circle"></i>
          </span>

           <!-- $inputType | Тип компонента и чек-->
					<?= view2('settings/input-type', [ 'inputType'=>$compSett['component-type'], 'compSett'=>$compSett ]); ?>
           <!-- end -->

            <!-- имя гурппы(для связи с отдельным блоком) -->
            <span class="d-block">
		        <label class="d-block">Имя группы
                    <small>Если указано имя, группа не будет отображаться. Связь с отдельным компонентом</small>
                    <small>Имя должно быть уникальным <b>(css_selector)</b></small>
                </label>
		        <input type="text" name="connection-name" class="connection-name-group" value="<?= $compSett['connection-name'] ?>">
            </span>
            <!-- end -->


           <!-- $align | Выравнивание-->
					<?= view2('settings/align-elements', [ 'align'=>$compSett['align-elements'],'isArea'=>$compSett['is_area'], ]); ?>
           <!-- end -->


           <!-- $align | Дополнительный класс елементу-->
					<?= view2('settings/add-class', [ 'addClass'=>$compSett['add-class'] ]); ?>
           <!-- end -->

           <!-- $align | Для блока детализации -->
					<?= view2('settings/for-detailind', [
						'forDetailing'=>$compSett['for-detailing'],
						'comp'=>$comp,
					]); ?>
           <!-- end -->

					<? include FREECALC_INC . 'view/partials/component-footer.php'; ?>
         </div>

       <button type="button" class="btn btn-light btn-green add-elem" title="Добавить елемент">
          <i class="fal fa-plus-square"></i>
       </button>
    <? endif; ?>
</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>