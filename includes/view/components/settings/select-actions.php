<span class="d-block">
		<label class="d-block">Какое действие выполнить
         <small>Привязать к столешнице</small>
      </label>
		<select name="select-action">
			<option value="">-----</option>
			<option value="mult-area" <?= valueIf($actions==='mult-area', 'selected') ?>>* на площадь столешницы</option>
			<option value="mult-length" <?= valueIf($actions==='mult-length', 'selected') ?>>* на длинну столешницы</option>
		</select>
</span>

<span class="row">
	<span>
		<label class="d-block">Какое действие выполнить
			 <small>Привязать к столешнице</small>
		</label>
		<select name="select-action">
			<option value="">-----</option>
			<option value="mult-area" <?= valueIf($actions==='mult-area', 'selected') ?>>* на S столешницы</option>
			<option value="mult-length" <?= valueIf($actions==='mult-length', 'selected') ?>>* на L столешницы</option>
		</select>
	</span>

	<span>
		<label class="d-block">Детализация
			 <small>это число</small>
		</label>
			<input type="checkbox" name="is_show_action_detail" <?=valueIf($compSett['is_show_action_detail']=='on', 'checked') ?>>
	</span>
</span>