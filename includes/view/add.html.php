
<h1 class="text-secondary">Настроить Калькулятор</h1>

<form class="form-change freecalc" method="post" action="">

   <div class="freecalc-header widgets-holder-wrap padding">
      <div class="form-group">
         <input type="hidden" class="page-url" value="<?= $_SERVER['REQUEST_URI'] ?>">
         <input type="hidden" id="page-edit" value="<?= $link_edit ?>">
         <input type="hidden" class="page-type" value="create">
         <input type="text" class="form-control input-middle" name="calc-name" value="" placeholder="Имя калькулятора" required /><!---->
      </div>
   </div>

   <!-- Settings calc -->
  <? include FREECALC_INC.'view/partials/calc-settings.php'?>


   <div class="freecalc-body">
      <!-- Сюда добавляются колонки -->
      <div class="container-calc row" id="content-column">
				<? include FREECALC_INC . 'view/components/column.php'; ?>
      </div>
      <!-- /end -->
   </div>

   <div class="freecalc-footer">
      <div class="wrap">
         <!-- Добавить колонку -->
         <button type="button" class="btn btn-light btn-green add-column" title="Добавить колонку">
            <i class="fal fa-plus-square"></i>
         </button>
      </div>

     <div class="mx-block_wrap_price">
         <input type="hidden" id="mxpctyw_wpnonce" name="mxpctyw_wpnonce" value="<?php /*echo wp_create_nonce( 'mxpctyw_nonce_request' ) ;*/?>" />
         <button class="button-primary save-calc" type="submit">Создать</button>
      </div>
   </div>


   <!-- Все компоненты должны лежать в форме, на нее подвешен обработчик -->

    <? include FREECALC_INC.'view/components/index.php'?>

</form>
