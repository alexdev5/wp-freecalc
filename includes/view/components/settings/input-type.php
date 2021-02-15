
<span class="row">
   <span class="d-block">
		<label class="d-block">Тип элемента</label>
		<select name="component-type">
				<option value="checkbox" <?= valueIf($inputType==='checkbox', 'selected') ?>>Checkbox</option>
				<option value="radio" <?= valueIf($inputType==='radio', 'selected') ?>>Radio</option>
		</select>
   </span>

   <span class="d-block">
			<label>Расположение элементов
            <small></small>
			</label>

			<select name="type-group">
            <option value="row" <?= valueIf($compSett['type-group']=='row', 'selected') ?>>Flex (рядом)</option>
            <option value="ds-block" <?= valueIf($compSett['type-group']=='ds-block', 'selected') ?>>Block</option>
			</select>
</span>

   <span>
      <label class="d-block">Не считать стоимость</label>
          <input type="checkbox" name="isnt_add_price" <?=valueIf($compSett['isnt_add_price']=='on', 'checked') ?>>
   </span>
</span>