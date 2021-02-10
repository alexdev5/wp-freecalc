
<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */ ?>

<? $imgSrc = valueIf($compSett['img-src'], '',FREECALC_ADMIN.'img/components/no-image.png'); ?>

<div class="<?= $classes ?>" <?= $dataset . $styles ?>>

	<? if (is_admin()){
		include FREECALC_INC . 'view/partials/btn-del-elem.php';
		/* Start content component */
		echo '<label class="ta-center component-html">';
	}  ?>

    <? if ($compSett['img-src'] ||  is_admin()): ?>
        <a href="<?= $compSett['img-src'] ?>" data-fancybox class="scale-img__link">
            <i class="fal fa-search-plus scale-img"></i>
        </a>
    <? endif;?>

    <span class="row__img">
        <img src="<?= $imgSrc ?>" alt="" class="img-for-input">
    </span>
    <label for="<?= $nameCheck ?>">
	<? /* input, в котором будет выводится цена */ ?>
	<?= view2('settings/html-input-price', [
		'name'=>$name,
		'compSett'=>$compSett,
		'comp'=>$comp,
		'group'=>$group,
	]); ?>
       <div class="row__text">
          <p <?= fchangeText()?> class="text"><?= valueIf($adata['text'], '', 'Изменить') ?></p>
          <p  <?= fchangeText()?> class="text-name <?= valueIf(!is_admin(), 'ds-none') ?>"><?= valueIf($adata['text1'], '', 'Детализация') ?></p>
       </div>

    </label>

	<!-- Настройки -->
	<? if (is_admin()): ?>
</label>
<!-- end content component -->

   <div class="component-settings delete-save">
      <span class="close"><i class="fal fa-times-circle"></i></span>

       <!-- $price | Цена -->
           <?= view2('settings/price', ['price'=>$compSett['price'],'priceType'=>$compSett['price-type'], ]); ?>
       <!-- end -->


      <!-- $srcImg | Ссылка на изображение -->
      <?= view2('settings/img-src', ['srcImg'=>$compSett['img-src'] ]); ?>
      <!-- end -->


       <!-- $srcImg | Ссылка на изображение fancy-box -->
           <?= view2('settings/img-click', ['clickImg'=>$compSett['img-click'] ]); ?>
       <!-- end -->


      <!-- $inputType | Тип компонента -->
      <?= view2('settings/input-type', [ 'inputType'=>$compSett['component-type'] ]); ?>
      <!-- end -->


      <? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

   </div>
<? endif; ?>
</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>