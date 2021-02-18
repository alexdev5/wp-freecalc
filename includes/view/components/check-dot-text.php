
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* Radiobox в виде точки слева и тектса справа */
?>

<label class="<?= $classes . valueIf(!is_admin(), ' check-circle') ?>"
  <?= $dataset . $styles?> >

	<? if (is_admin())
	    include FREECALC_INC . 'view/partials/btn-del-elem.php'; ?>


   <?= valueIf(is_admin(), ' <label class="custom-check component-html">') ?>
		 <? /* input, в котором будет выводится цена */ ?>
		 <?= view2('settings/html-input-price', [
				 'name'=>$name,
				 'compSett'=>$compSett,
				 'comp'=>$comp,
				 'group'=>$group,
				 'id'=>'',
		 ]); ?>
      <label <?= fchangeText() ?> class="text" for="<?= $nameCheck ?>">
        <?= valueIf($adata['text'], '', "Изменить") ?>
      </label>
	<?= valueIf(is_admin(), '</label>') ?>



	<? if (is_admin()): ?>
        <!-- Settings -->
        <div class="component-settings delete-save">
            <span class="close"><i class="fal fa-times-circle"></i></span>

           <!-- $price | Цена -->
					<?= view2('settings/price', [
						'price'=>$compSett['price'],
						'compSett'=>$compSett,
					]); ?>
           <!-- end -->


           <!-- $inputType | Тип компонента -->
					<?= view2('settings/input-type', [ 'inputType'=>$compSett['component-type'] ]); ?>
           <!-- end -->


           <!-- $inputType | Тип компонента -->
					<?= view2('settings/connection-one-component', [ 'connection'=>$compSett['connection'] ]); ?>
           <!-- end -->


           <!-- $align | Для блока детализации -->
					<?= view2('settings/for-detailind', [
						'forDetailing'=>$compSett['for-detailing'],
						'comp'=>$comp,
					]); ?>
           <!-- end -->


					<? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

        </div>
    <? endif; ?>
</label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>