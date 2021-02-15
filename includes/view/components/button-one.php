
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
?>

<div class="<?= $classes . valueIf(!is_admin(), ' ta-center') ?>"  <?= $dataset . $styles ?> >
	<? if (is_admin())
		include FREECALC_INC . 'view/partials/btn-del-elem.php'; ?>

	<?= fis_admin('<label class="custom-check component-html">') ?>

	<? if ($compSett['add-class-fa']): ?>
		<i class="<?= $compSett['add-class-fa'] ?>"></i>
	<? endif; ?>

	<spna <?= fchangeText()?>>
		<?= valueIf($adata['text'], '', 'Текст') ?>
	</spna>
	<?= fis_admin('</label>') ?>


	<!-- Settings -->
	<? if (is_admin()): ?>
		<div class="component-settings delete-save">
			<span class="close"><i class="fal fa-times-circle"></i></span>

			<span class="d-block">
				<label class="d-block">Дабавить иконку FA</label>
				<input type="text" placeholder="FA class" name="add-class-fa" value="<?= $compSett['add-class-fa'] ?>">
			</span>

			<!-- $align | Дополнительный класс елементу-->
			<?= view2('settings/add-class', [ 'addClass'=>$compSett['add-class'] ]); ?>
			<!-- end -->

			<!-- $style | Свои стили -->
			<?= view2('settings/custom-styles', [ 'style'=>$compSett['custom-style'] ]); ?>

			<!-- Кнопка "ОК" -->
			<?= view2('settings/btn-ok'); ?>
			<!-- end -->

		</div>
	<? endif; ?>

</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>