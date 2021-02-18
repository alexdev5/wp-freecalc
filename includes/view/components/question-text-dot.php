
<?
/* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/*  */ ?>

<label class="<?= $classes;?> check-circle" <?= $dataset . $styles ?>>

	<? if (is_admin())
		include FREECALC_INC . 'view/partials/btn-del-elem.php'; ?>

	<?= fis_admin('<div class="component-html">') ?>

	<? if ($compSett['img-src'] || is_admin()): ?>
     <a class="btn-light btn-question" href="<?= $compSett['img-src'] ?>" data-fancybox>(?)</a>
	<? endif; ?>

  <span <?= fchangeText()?> class="text" for="<?= $nameCheck ?>"><?= valueIf($adata['text'], '', 'Изменить текст') ?></span>

     <? /* input, в котором будет выводится цена */ ?>
     <?= view2('settings/html-input-price', [
         'name'=>$name,
         'compSett'=>$compSett,
         'comp'=>$comp,
         'group'=>$group,
     ]); ?>

	<?= fis_admin('</div>') ?>


   <!-- Settings -->
	<? if (is_admin()): ?>
     <div class="component-settings delete-save">
          <span class="close">
             <i class="fal fa-times-circle"></i>
          </span>

        <!-- $price | Цена -->
			 <?= view2('settings/price', [
				 'price'=>$compSett['price'],
				 'compSett'=>$compSett,
			 ]); ?>
        <!-- end -->


        <!-- $price | Выбрать действие -->
			 <?= view2('settings/select-actions', ['actions'=>$compSett['select-action'],'compSett'=>$compSett, ]); ?>
        <!-- end -->


        <!-- $srcImg | Ссылка на изображение -->
			 <?= view2('settings/img-src', ['srcImg'=>$compSett['img-src'] ]); ?>
        <!-- end -->

        <!-- $align | Дополнительный класс елементу-->
			 <?= view2('settings/add-class', [ 'addClass'=>$compSett['add-class'] ]); ?>
        <!-- end -->

			 <? include FREECALC_INC . 'view/partials/component-footer.php'; ?>

     </div>
	<? endif; ?>
</label>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>