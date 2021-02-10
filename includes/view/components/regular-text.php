<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* Radiobox в виде точки слева и тектса справа */ ?>

<div class="<?= $classes ?>" <?= $dataset . $styles?>>
	<? if (is_admin()){
		 include FREECALC_INC . 'view/partials/btn-del-elem.php';
		 /* Start content component */
		 echo '<div class="component-html">';
	 } ?>

        <p <?= fchangeText()?> class="text">
            <?= valueIf($adata['text'], '', 'Регулятный текст') ?>
        </p>


	<? if (is_admin()){
	   echo '</div>';
		  /*end content component*/
	 } ?>


</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>