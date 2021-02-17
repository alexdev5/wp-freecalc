

<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* */?>
<div class="worktop-comp <?= $classes?>"
	<?= $dataset . $styles ?>>

	<? if (is_admin())
		include FREECALC_INC . 'view/partials/btn-del-elem.php';?>
	<?= fis_admin('<label class="component-html">'); ?>

	<!-- ** -->
	<div class="worktop-comp__relative">
		<img src="<?= FREECALC_ADMIN.'img/worktop/windowsill-mirrored.svg' ?>" alt="" class="worktop-line__img">

      <input type="hidden" data-price="<?= $compSett['price-install-min'] ?>">
      <input type="hidden" data-price-min="<?= $compSett['price-install-min'] ?>">
      <input type="hidden" data-fixed-min="<?= $compSett['install-fixed-min'] ?>">

		<div class="individual-group"
				 data-price="<?= $compSett['wprice-area'] ?>"
				 data-name="<?= $nameCheck.':area' ?>">
			<? /* data-calc-target: с каким елементом производить действие */ ?>
			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number w1 individual">
			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number w2 individual">
			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number w3 individual">

			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number l1 individual">
			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number l2 individual">
			<input type="number"
						 data-typecalc="individual"
						 class="absolute input-number l3 individual">
		</div>
	</div>
	<!-- /** -->

	<?= fis_admin('</label>') ?>


	<!-- Настройки -->
	<? if (is_admin()): ?>
		<div class="component-settings delete-save">
			<span class="close"><i class="fal fa-times-circle"></i></span>

			<!-- $price | Цена -->
			<?= view2('settings/windowsill-price', ['compSett'=>$compSett ]); ?>
			<!-- end -->

			<? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

		</div>
	<? endif; ?>
</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>