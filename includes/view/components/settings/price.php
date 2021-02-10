<span class="row">
   <span>
      <label class="d-block">Цена </label>
		<input type="number" step="0.01" placeholder="Цена" name="price" value="<?= $price ?>">
   </span>
   <span>
      <label class="d-block">Не расчитывать small</label>
		<select name="price-type">
				<option value="single" <?= valueIf($priceType==='single', 'selected') ?>>едн.</option>
				<option value="perc" <?= valueIf($priceType==='perc', 'selected') ?>>%</option>
		</select>
   </span>
</span>