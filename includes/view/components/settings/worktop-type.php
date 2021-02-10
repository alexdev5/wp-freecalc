<span class="d-block">
		<? if ($is_worktop): ?>
         <label class="d-block">Тип столешницы</label>
      <? else: ?>
         <label class="d-block">Если столешница, то выберите тип</label>
         <small>(Установить связь с изображением столешницы)</small>
      <? endif; ?>
		<select name="component-type__worktop">
				<? if (!$is_worktop): ?>
               <option value=""> ----- </option>
            <? endif; ?>
				<option value="worktop-line" <?= valueIf($worktop==='worktop-line', 'selected') ?>>Праямая</option>
				<option value="worktop-g" <?= valueIf($worktop==='worktop-g', 'selected') ?>>Г - образная</option>
				<option value="worktop-p" <?= valueIf($worktop==='worktop-p', 'selected') ?>>П - образная</option>
		</select>
</span>