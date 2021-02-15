<? /* Переменные для компонента */
include FREECALC_INC . 'view/partials/component-before.php';
/* */ ?>
    <div class="worktop-comp <?= $classes?>"
        <?= $dataset . $styles ?> >

        <? if (is_admin())
            include FREECALC_INC . 'view/partials/btn-del-elem.php';?>
        <?= fis_admin('<label class="component-html">'); ?>


        <!-- ** start ** -->
       <div class="worktop-comp__relative">
           <img src="<?= FREECALC_ADMIN.'img/worktop/worktop-p.svg' ?>" alt="" class="worktop-line__img">
           <!-- углы -->
          <div class="radial-group">
                <? for ($radial = 1; $radial<=6; $radial++): ?>
               <label class="check-mark check-mark-<?= $radial ?>">
                  <input type="checkbox" class="check-radial reg-calc"
                         data-price="<?= $compSett['wprice-radial'] ?>"
                        <?= valueIf($compSett['radial-fixed']=='on', 'data-fixed="fixed"') ?>
                         name="<?= $nameCheck.':'.$radial ?>">
                  <span></span>
               </label>
                <? endfor; ?>
          </div>


           <label class="check-mark mark-panel">
               <input type="checkbox" class="check-panel reg-calc"
                      data-price="<?= $compSett['wprice-panel'] ?>"
                       <?= valueIf($compSett['panel-fixed']=='on', 'data-fixed="fixed"') ?>
                      name="<?= $nameCheck.':6' ?>">
               <span></span>
           </label>
          <!-- <label class="check-mark mark-stone">
               <input type="checkbox" class="check-stone reg-calc" data-price="<?/*= $compSett['wprice-stone'] */?>" name="<?/*= $nameCheck.':7' */?>">
               <span></span>
           </label>
           <label class="check-mark mark-washing">
               <input type="checkbox" class="check-washing reg-calc" data-price="<?/*= $compSett['wprice-washing'] */?>" name="<?/*= $nameCheck.':8' */?>">
               <span></span>
           </label>-->

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
        <!-- /** end ** -->

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