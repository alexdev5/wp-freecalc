<?
$promocodes = $data->promocode;
$settings = $data->settings;
?>

<div class="freecalc fsetting ">
   <div class="wrap">
      <h1>Дополнительные настройки</h1>
   </div>

   <div class="wrap freebody mr15">
      <div class="fsetting-header row ai-center">
         <h2>Промокоды</h2>
         <button class="add-new button-primary button-success" data-tmp=".template-promocode .promocode" data-to="#promocode">+ Добавить новый</button>
         <!-- Генерировать -->
         <div class="random-block">
            <div class="random btn-a">
               <i class="fad fa-random"></i>
            </div>
            <input type="number" class="form-control length" placeholder="Длинна кода">
            <label> Числа
               <input type="checkbox" class="form-control is-num">
            </label>
            <label> Буквы
               <input type="checkbox" class="form-control is-letter">
            </label>
         </div>
      </div>
      <hr>

      <form action="" class="freecalc-settings-form">
         <div id="promocode">
            <? foreach ($promocodes as $item){
               echo view('includes/view/partials/tmp-promocode', ['item'=>$item]);
            } ?>
         </div>

         <div id="setitngs">

         </div>

         <div class="wrap">
            <button class="button-primary save-settings absolute" type="submit">Сохранить</button>
         </div>
      </form>
   </div>

   <div class="template template-promocode">
      <?=  view('includes/view/partials/tmp-promocode'); ?>
   </div>
</div>