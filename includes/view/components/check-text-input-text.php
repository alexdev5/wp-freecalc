
<?
/* Тектс в рамке, checkbox
   fchangeText() - return: contenteditable=true data-text
 */
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
?>

<label class="<?= $classes; ?> check-circle input-red calc-dot-number"
       <?= $dataset . $styles ?> >

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

      <label <?= fchangeText()?> class="text" for="<?= $nameCheck?>">
        <?= valueIf($adata['text'], '', 'Изменить текст') ?>
      </label>
      <input type="number" step="0.01" class="bd-red text-mini" data-price="<?= $compSett['price'] ?>" value="1">
      <label <?= fchangeText()?> class="text">
				<?= valueIf($adata['text1'], '', 'изменить текст') ?>
      </label>

      <? if ($compSett['img-src']): ?>
         <a class="btn-light btn-question" data-fancybox href="<?= $compSett['img-src'] ?>">(?)
         </a>
      <? endif; ?>
	<?= fis_admin(' </label>') ?>



	<? if (is_admin()): ?>
      <!-- Settings -->
        <div class="component-settings delete-save">
            <span class="close"><i class="fal fa-times-circle"></i></span>

           <!-- $price | Цена -->
					<?= view2('settings/price', ['price'=>$compSett['price'],'priceType'=>$compSett['price-type'], ]); ?>
           <!-- end -->

           <!-- $srcImg | Ссылка на изображение -->
					<?= view2('settings/img-src', ['srcImg'=>$compSett['img-src'] ]); ?>
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