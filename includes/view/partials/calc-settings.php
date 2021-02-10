

<div class="calc-settings widgets-holder-wrap padding m10">
	<h2>Общие настройки</h2>
<!-- При создании новой настройки:
 это должен быть input, select
 сохраняяется объект: name:value
 -->
   <div class="row ai-top">
      <div class="form-group">
         <label>
            Валюта на вводе:
            <small>В какой валюте указывается цена?</small>
         </label>
         <select name="calc_curr_in" class="calc-curr">
            <option value="rub" <?= valueIf($settings['calc_curr_in']=='rub', 'selected'); ?>>RUB</option>
            <option value="usd" <?= valueIf($settings['calc_curr_in']=='usd', 'selected'); ?>>USD</option>
         </select>
      </div>
      <div class="form-group">
         <label>
            Валюта на выводе:
            <small>Будет выводится во фронтенде, пересчитываться по курсу</small>
         </label>
         <select name="calc_curr_out" class="calc-curr">
            <option value="rub" <?= valueIf($settings['calc_curr_out']=='rub', 'selected'); ?>>RUB</option>
            <option value="usd" <?= valueIf($settings['calc_curr_out']=='usd', 'selected'); ?>>USD</option>
         </select>
      </div>
      <div class="form-group">
         <label>Число для конвертации в м
         <small>Разделить эденицу на это число</small>
         </label>
         <input type="number" name="conversion_factor" value="<?= valueIf($settings['conversion_factor']); ?>" class="form-control" placeholder="Сonversion factor to meters">
      </div>
      <div class="form-group">
         <label>Текущий курс $
         <small>Автоматическое обновление</small>
         </label>
         <input type="text" disabled="disabled" value="<?= get_option('balrate_usd')+0 .' RUB'; ?>">
      </div>
      <div class="form-group">
         <label>Ручная корректировка $
         <small>Если указано, будет браться этот</small>
         </label>
         <input type="number" name="balrate_usd_manual" value="<?= $settings['balrate_usd_manual'] ?>">
      </div>
   </div>

</div>