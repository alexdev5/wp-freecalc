
<span class="row">
    <span class="fg-1">
        <label class="d-block">Цена установки</label>
        <input type="number" name="price-install" value="<?= $compSett['price-install'] ?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="install-fixed" <?= valueIf($compSett['install-fixed']=='on', 'checked') ?>>
    </span>
</span>

<span class="row">
    <span class="fg-1">
        <label class="d-block">Минимальная цена</label>
		<input type="number" name="price-install-min" value="<?= $compSett['price-install-min'] ?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="install-fixed-min" <?= valueIf($compSett['install-fixed-min']=='on', 'checked') ?>>
    </span>
</span>


