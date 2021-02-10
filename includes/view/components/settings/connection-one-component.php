
<span class="d-block">
		<label class="d-block">При выборе елемента, отображать группу
		<small>Укажите, какую группу отображать если этот эелемент активен</small>
		</label>
		<span class="row">
			<select name="connection" class="connection-group">
				<option value="">------</option>
				<? if ($connection): ?>
					<option selected><?= $connection?></option>
				<? endif; ?>
			</select>

			<i class="far fa-sync-alt btn-select__name"></i>
		</span>
</span>