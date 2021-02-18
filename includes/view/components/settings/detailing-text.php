
<span class="row ai-top nowrap">
	<span class="d-block">
			<label class="d-block">Выводить в детализации
                 <small>Свой текст</small>
            </label>
			<input type="text" placeholder="Текст во второй колонке" name="detailing-text" value="<?= $compSett['detailing-text'] ?>">
	</span>
		<span class="d-block">
				 <label>Текущий текст
                 <small>Что в компоненте</small>
                 </label>
				<input type="checkbox" name="is_current_text" <?=valueIf($compSett['is_current_text']=='on', 'checked') ?>>
		</span>
</span>