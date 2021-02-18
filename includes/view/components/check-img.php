
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */
?>
<label class="<?= $classes . $class_active ?>"
       <?= $dataset ?>  <?= $classes?> >

	<? if (is_admin())
		 include FREECALC_INC . 'view/partials/btn-del-elem.php';?>

    <?= fis_admin('<label class="component-html custom-check">');
		 $imgSrc = valueIf($compSett['img-src'], '',FREECALC_ADMIN.'img/woocommerce-placeholder-1024x1024.png');
    ?>

      <img src="<?= $imgSrc ?>" alt="" class="img-for-input">
			<? /* input, в котором будет выводится цена */ ?>
			<?= view2('settings/html-input-price', [
					 'name'=>$name,
					 'compSett'=>$compSett,
					 'comp'=>$comp,
					 'group'=>$group,
					 'isSpan'=>false,
			]); ?>
        <p <?= fchangeText()?> class="text">
          <?= valueIf($adata['text'], '', 'Изменить') ?>
        </p>
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


           <!-- $tableType | Выбрать тип столешницы -->
           <?= view2('settings/worktop-type', [ 'worktop'=>$compSett['component-type__worktop'] ]); ?>
           <!-- end -->


					<? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

        </div>
    <? endif; ?>
</label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>