<span class="row">
   <span>
      <label class="d-block">Цена </label>
		<input type="number" step="0.01" placeholder="Цена" name="price" value="<?= $price ?>">
   </span>
   <span>
      <label class="d-block">Дополнительно</label>
		<select name="price-type" class="action-price">
         <option value="">-------</option>
         <option value="install-windowsill" <?= valueIf($compSett['price-type']==='install-windowsill', 'selected') ?>>Монтаж подоконника</option>
         <option value="price-washing" <?= valueIf($compSett['price-type']==='price-washing', 'selected') ?>>Цена для мойки</option>
         <option value="is-washing" <?= valueIf($compSett['price-type']==='is-washing', 'selected') ?>>Интегрированая мойка</option>

		</select>
   </span>
</span>

<!-- Настройка создается так:
 Сначала в "option" придумывается "value"
 Потом ниже в "input" в поле "name" вводится тот же "value" с "option"
 только в конец добавляется: "-set"
 На фронтенде нужно описывать отдельно в "updatePrice"
 -->
<span class="d-block for-action-price">
   <!-- Монтаж -->
   <span class="install-windowsill <?= valueIf($compSett['price-type']==='install-windowsill', ' ', 'ds-none') ?>">
      <label class="d-block">Минимальная стоимость монтажа </label>
      <input type="number" step="0.01" placeholder="Цена" name="install-windowsill-set" value="<?= $compSett['install-windowsill-set'] ?>">
   </span>

   <!-- Мойка цена -->
   <span class="price-washing <?= valueIf($compSett['price-type']==='price-washing', ' ', 'ds-none') ?>">
      <label class="d-block">Стоимость интегрированой мойки
      <small>Указывать в категории камня</small></label>
      <input type="number" step="0.01" placeholder="Цена" name="price-washing-set" value="<?= $compSett['price-washing-set'] ?>">
   </span>

</span>