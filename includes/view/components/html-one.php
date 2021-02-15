
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
?>

<div class="<?= $classes . valueIf(!is_admin(), ' ta-center') ?>"  <?= $dataset . $styles ?> >
	<? if (is_admin())
		include FREECALC_INC . 'view/partials/btn-del-elem.php'; ?>

	<?= fis_admin('<label class="component-html">') ?>

	<!-- start -->
	<? if (is_admin()): ?>
	<label class="component-html">
		<textarea name="html-content" data-text><?= $adata['text'] ?></textarea>
	</label>
	<? else: ?>
		<?= htmlspecialchars_decode($adata['text'])?>
	<? endif; ?>
	<!-- /end -->

</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>