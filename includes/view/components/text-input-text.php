
<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* */ ?>


<div class="<?= $classes ?>" <?= $dataset . $styles ?>>

	<? if (is_admin()){
		 include FREECALC_INC . 'view/partials/btn-del-elem.php';
		 /* start content component*/
		 echo '<label class="custom-check component-html">';
   } ?>

      <label <?= fchangeText()?>>
				<?= valueIf($adata['text'], '', 'изменить текст') ?>
      </label>

      <input type="number" step="0.01" name="<?= $nameCheck ?>" class="bd-red text-mini" data-price="<?= $compSett['price'] ?>">

      <label <?= fchangeText()?>>
         <? if ($adata['text']&&!$adata['text1']){
            echo ' ';
         }
         elseif($adata['text1']){
            echo $adata['text1'];
         }
         else {
            echo 'Изменить текст';
         }
         ?>
      </label>

   <? if (is_admin()): ?>
      </label>
      <!-- end content component -->

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

</div>
<? include FREECALC_INC . 'view/partials/component-after.php'; ?>