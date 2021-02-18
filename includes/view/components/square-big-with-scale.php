
<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */ ?>

<label class="<?= $classes ?>" <?= $dataset . $styles ?>>

	<? if (is_admin()){
		include FREECALC_INC . 'view/partials/btn-del-elem.php';
		/* Start content component */
		echo '<label class="ta-center component-html">';
	}  ?>

    <? if ($compSett['img-src'] ||  is_admin()): ?>
        <a href="<?= $compSett['img-src'] ?>" data-fancybox class="scale-img__link">
            <i class="fal fa-search-plus scale-img"></i>
        </a>
    <? endif;
    $imgSrc = valueIf($compSett['img-src'], '',FREECALC_ADMIN.'img/components/no-image.png');
		$nameCheck = $name.':'.$comp['column-id'].':'
			.$comp['group-id'].':'
			.$comp['group-block-id'].':'
			.$comp['component-id'];
    ?>
    <label for="<?= $nameCheck?>">

	<? /* input, в котором будет выводится цена */ ?>
	<?= view2('settings/html-input-price', [
		'name'=>$name,
		'compSett'=>$compSett,
		'comp'=>$comp,
		'group'=>$group,
	]); ?>
    <p <?= fchangeText()?> class="text row__text">
        <?= valueIf($adata['text'], '', 'Изменить') ?>
    </p></label>

	<!-- Настройки -->
	<? if (is_admin()): ?>
</label>
<!-- end content component -->

   <div class="component-settings delete-save">
      <span class="close"><i class="fal fa-times-circle"></i></span>

      <!-- $srcImg | Ссылка на изображение -->
      <?= view2('settings/img-src', ['srcImg'=>$compSett['img-src'] ]); ?>
      <!-- end -->


      <!-- $price | Цена -->
		 <?= view2('settings/price', [
			 'price'=>$compSett['price'],
			 'compSett'=>$compSett,
		 ]); ?>
      <!-- end -->


      <!-- $inputType | Тип компонента -->
      <?= view2('settings/input-type', [ 'inputType'=>$compSett['component-type'] ]); ?>
      <!-- end -->


      <? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

   </div>
<? endif; ?>
</label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>