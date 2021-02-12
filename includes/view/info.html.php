<div class="freecalc">

   <div class="wrap">
      <h1>Краткая информация по плагину</h1>
   </div>

   <div class="wrap freebody">
      <b><?= FREECALC_URL .'info.txt' ?></b>
      <pre>
         <?= file_get_contents(FREECALC_PATH.'info.txt') ?>
      </pre>
   </div>
</div>