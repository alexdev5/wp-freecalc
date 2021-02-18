
<?/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */ ?>

<? /* $name - передается с цикла: view/components/index.php */ ?>
    <label class="<?= $classes ?>" <?= $dataset . $styles ?>>

        <? if (is_admin())
            include FREECALC_INC . 'view/partials/btn-del-elem.php';?>

        <?= fis_admin('<label class="component-html">');
        $imgSrc = valueIf($compSett['img-src'], '',FREECALC_ADMIN.'img/components/no-image.png');
        ?>

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

        <span class="row__text">
            <span <?= fchangeText()?> class="text"><?= valueIf($adata['text'], '', 'Изменить') ?></span>
            <span <?= fchangeText()?> class="text text-name <?= valueIf(!is_admin(), 'ds-none') ?>"><?= valueIf($adata['text1'], '', 'Имя материала') ?></span>
        </span>

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


              <!-- $inputType | Тип компонента -->
						<?= view2('settings/input-type', [ 'inputType'=>$compSett['component-type'] ]); ?>
              <!-- end -->

              <!-- $inputType | Зависимость -->
						<?= view2('settings/connection-one-component', [ 'connection'=>$compSett['connection'] ]); ?>
              <!-- end -->

                <? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

          </div>
			<? endif; ?>
    </label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>