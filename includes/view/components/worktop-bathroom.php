<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* */?>
	<div class="worktop-comp <?= $classes . $class_active?>"
		<?= $dataset . $styles ?>>

		<? if (is_admin())
			include FREECALC_INC . 'view/partials/btn-del-elem.php';?>
		<?= fis_admin('<label class="component-html">'); ?>

		<!-- ** start ** -->
		<div class="worktop-comp__relative">
			<img src="<?= FREECALC_ADMIN.'img/worktop/worktop-bathroom.svg' ?>" alt="" class="worktop-line__img">

			<div class="individual-group"
					 data-price="<?= $compSett['wprice-area'] ?>"
					 data-name="<?= $nameCheck.':area' ?>">
				<? /* data-calc-target: с каким елементом производить действие */ ?>
				<input type="number"
							 data-typecalc="individual"
							 class="absolute input-number w1 individual">

				<input type="number"
							 data-typecalc="individual"
							 class="absolute input-number l1 individual">
			</div>
		</div>
		<!-- ** end ** -->

		<?= fis_admin('</label>') ?>


		<!-- Настройки -->
		<? if (is_admin()): ?>
			<div class="component-settings delete-save">
				<span class="close"><i class="fal fa-times-circle"></i></span>

				<!-- $price | Цена -->
				<?= view2('settings/worktop-price', ['compSett'=>$compSett ]); ?>
				<!-- end -->

				<? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

			</div>
		<? endif; ?>
	</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>