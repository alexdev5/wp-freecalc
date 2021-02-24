<?
$promocodes = $data->promocode;
$settings = $data->settings;
?>

<div class="freecalc">
   <div class="wrap">
      <h1>Дополнительные настройки</h1>
   </div>

   <!-- Промокоды -->
   <form class="fsetting">
       <div class="wrap promocodes freebody mr15">
           <div class="fsetting-header row ai-center">
               <h2>Промокоды</h2>
               <div class="add-new button-primary button-success" data-tmp=".template-promocode .promocode" data-to="#promocode">+ Добавить новый</div>
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
           <div class="freecalc-promocode">
               <div id="promocode">
                 <? foreach ($promocodes as $item){
                     echo view('includes/view/partials/tmp-promocode', ['item'=>$item]);
                 } ?>
               </div>
           </div>
       </div>


       <!-- Другие настройки -->
       <div class="wrap freebody mr15 freecalc-settings" id="setitngs">
           <div class="fsetting-header row ai-center">
               <h2>Дополнительно</h2>
           </div>
           <hr>

          <!-- Ключ апи pdf https://pdflayer.com/dashboard -->
          <div class="settings-block">
             <div class="fz14">
                <span class="ds-block label bold">Ключ API для генерации PDF (<a href="https://pdflayer.com/dashboard" class="c-grey">https://pdflayer.com/dashboard</a>). Лимит 100 запросов в 1 мес.
                </span>
                <input type="text" name="pdflayer-api-key" value="<?= $settings['pdflayer-api-key'] ?>">
             </div>
          </div>


           <!-- Добавить текст внизу калькулятора -->
           <div class="text-editor settings-block">
               <div class="fz14 bold">
                   <span>Текст будет выводится внизу калькулятора</span>
                   <textarea name="text-editor" id="free-editor"><?= htmlspecialchars_decode($settings['text-editor']) ?></textarea>
               </div>
           </div>

           <div class="wrap">
               <button class="button-primary save-settings absolute" type="submit" name="settings">Сохранить</button>
           </div>
       </div>
   </form>

   <div class="template template-promocode">
      <?=  view('includes/view/partials/tmp-promocode'); ?>
   </div>


   <!-- Дополнительные настройки -->
</div>
