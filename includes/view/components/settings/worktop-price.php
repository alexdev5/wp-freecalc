
<span class="row">
    <span class="fg-1">
        <label class="d-block">Цена | скругления угла</label>
        <input type="number" name="wprice-radial" value="<?= $compSett['wprice-radial'] ?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="radial-fixed" <?= valueIf($compSett['radial-fixed']=='on', 'checked') ?>>
    </span>
</span>

<span class="row">
    <span class="fg-1">
        <label class="d-block">Цена | Вырез под варочную панель</label>
		<input type="number" name="wprice-panel" value="<?= $compSett['wprice-panel'] ?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="panel-fixed" <?= valueIf($compSett['panel-fixed']=='on', 'checked') ?>>
    </span>
</span>

<!--<span class="row">
    <span>
        <label class="d-block">Цена | Мойка из камня</label>
		<input type="number" name="wprice-stone" value="<?/*= $compSett['wprice-stone'] */?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="stone-fixed" value="<?/*= valueIf($compSett['stone-fixed']=='on', 'checked') */?>">
    </span>
</span>-->
<!--<span class="row">
    <span>
        <label class="d-block">Цена | Вырез под мойку</label>
		<input type="number" name="wprice-washing" value="<?/*= $compSett['wprice-washing'] */?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="washing-fixed" value="<?/*= valueIf($compSett['washing-fixed']=='on', 'checked') */?>">
    </span>
</span>
<span class="row">
    <span>
        <label class="d-block">Цена | за площадь едн<sup>2</sup>
		<small>S * (едн.)</small>
		</label>
		<input type="number" name="wprice-area" value="<?/*= $compSett['wprice-area'] */?>">
    </span>
    <span>
         <label class="d-block">Фиксировать</label>
        <input type="checkbox" name="area-fixed" value="<?/*= valueIf($compSett['area-fixed']=='on', 'checked') */?>">
    </span>
</span>-->

