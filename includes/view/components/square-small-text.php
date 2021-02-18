
<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* */ ?>
<label class="<?= $classes?> in-iblock no-padding"
	<?= $dataset . $styles ?>>

	<? if (is_admin()){
		include FREECALC_INC . 'view/partials/btn-del-elem.php';
		/* start content component*/
		echo '<label class="component-html">';
	} ?>


	<? /* input, в котором будет выводится цена */ ?>
	<?= view2('settings/html-input-price', [
		'name'=>$name,
		'compSett'=>$compSett,
		'comp'=>$comp,
		'group'=>$group,
	]); ?>

	<!--<img src="<?/*= $compSett['img-src'] */?>" alt="">-->

    <h3 <?= fchangeText()?> class="text text-name">
			<?= valueIf($adata['text'], '', 'Текст 2') ?>
    </h3>
	<label <?= fchangeText()?> class="text">
		<?= valueIf($adata['text1'], '', 'Изменить') ?>
	</label>


  <? if (is_admin()): ?>
    </label>
    <!-- end content component -->

    <!-- Settings -->
    <div class="component-settings">
              <span class="close">
                 <i class="fal fa-times-circle"></i>
              </span>

       <!-- $price | Цена -->
			<?= view2('settings/price', [
				'price'=>$compSett['price'],
				'compSett'=>$compSett,
			]); ?>
       <!-- end -->

        <? include FREECALC_INC . 'view/partials/component-footer.php'; ?>
    </div>

<? endif; ?>
</label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>