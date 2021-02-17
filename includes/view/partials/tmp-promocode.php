<!-- Шаблон для: view/settings.html.php -->

<div class="promocode row ai-bottom">
	<div class="form-group">
		<label>Код промокода</label>
		<input type="text" class="form-control" name="promo-code" value="<?= $item['promo-code'] ?>">
	</div>
	<div class="form-group">
		<label>Скидка</label>
		<input type="number" name="promo-number" class="form-control" value="<?= $item['promo-number'] ?>">
	</div>
	<div class="form-group">
		<label>Процент от суммы или число</label>
		<select name="promo-type">
			<option value="perc" <?= valueIf($item['promo-type']=='perc', 'selected') ?>>Процент</option>
			<option value="number" <?= valueIf($item['promo-type']=='number', 'selected') ?>>Число</option>
		</select>
	</div>
	<div class="form-group fg-1">
		<label>Описание</label>
        <input type="text" name="promo-description" class="form-control w100" value="<?= $item['promo-description'] ?>">
	</div>


	<!-- Удалить -->
	<div class="deleted btn-a" title="Удалить елемент">
		<i class="fas fa-trash"></i>
	</div>
</div>