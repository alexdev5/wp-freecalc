
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */ ?>

	<label class="<?= $classes; ?>" <?= $dataset . $styles ?>>

		<? if (is_admin())
			include FREECALC_INC . 'view/partials/btn-del-elem.php';?>

        <? if ($compSett['img-src'] || is_admin()): ?>
            <a class="btn-light btn-question" data-fancybox href="<?= $compSett['img-click'] ?>">(?)</a>
        <? endif; ?>

		<?= fis_admin('<label class="component-html custom-check">');
		$imgSrc = valueIf($compSett['img-src'], '',FREECALC_ADMIN.'img/components/no-image.png');
		?>

        <!-- *** -->
        <span class="row__img">
            <img src="<?= $imgSrc ?>" alt="" class="img-for-input">
        </span>

		<? /* input, в котором будет выводится цена */ ?>
		<?= view2('settings/html-input-price', [
			'name'=>$name,
			'compSett'=>$compSett,
			'comp'=>$comp,
			'group'=>$group,
		]); ?>
        <span class="row__text" for="<?= $nameCheck?>">
            <p <?= fchangeText()?> class="text text-name"><?= valueIf($adata['text'], '', 'Изменить') ?></p>
        <? if ($adata['text1'] || is_admin()): ?>
            <p <?= fchangeText()?> class="text"><?= valueIf($adata['text1'], '', 'Текст 2') ?></p>
				<? endif; ?>
        </span>

        <!-- *** -->

		<?= fis_admin('</label>') ?>


		<!-- Настройки -->
		<? if (is_admin()): ?>
			<div class="component-settings delete-save">
				<span class="close"><i class="fal fa-times-circle"></i></span>

            <!-- $price | Цена -->
					 <?= view2('settings/price', [
						 'price'=>$compSett['price'],
						 'compSett'=>$compSett,
					 ]); ?>
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