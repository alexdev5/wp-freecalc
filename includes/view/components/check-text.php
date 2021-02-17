
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
?>

<label class="<?= $classes . valueIf(!is_admin(), ' ta-center') ?>"  <?= $dataset . $styles ?> >
  <? if (is_admin())
     include FREECALC_INC . 'view/partials/btn-del-elem.php'; ?>



   <?= fis_admin('<label class="custom-check component-html">') ?>
		 <? /* input, в котором будет выводится цена */ ?>
		 <?= view2('settings/html-input-price', [
				 'name'=>$name,
				 'compSett'=>$compSett,
				 'comp'=>$comp,
				 'group'=>$group,
		 ]); ?>

      <label <?= fchangeText()?> class="text">
        <?= valueIf($adata['text'], '', 'Текст') ?>
      </label>
	<?= fis_admin('</label>') ?>


    <!-- Settings -->
	<? if (is_admin()): ?>
        <div class="component-settings delete-save">
            <span class="close"><i class="fal fa-times-circle"></i></span>

           <!-- $price | Цена -->
					<?= view2('settings/price', ['price'=>$compSett['price'],'priceType'=>$compSett['price-type'], ]); ?>
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