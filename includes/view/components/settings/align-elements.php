

    <span class="row ai-top nowrap">
        <span class="d-block">
                <label>Выравнивание в группе
                    <small>( justify-content: --- )</small>
                </label>

                <select name="align-elements">
                        <option value="">--------</option>
                        <option value="flex-start" <?= valueIf($align==='flex-start', 'selected') ?>>Start</option>
                        <option value="center" <?= valueIf($align==='center', 'selected') ?>>Center</option>
                        <option value="space-between" <?= valueIf($align==='space-between', 'selected') ?>>Between</option>
                        <option value="space-around" <?= valueIf($align==='space-around', 'selected') ?>>Around</option>
                        <option value="fd-column" <?= valueIf($align==='fd-column', 'selected') ?>>Vertical</option>
                </select>
        </span>
        <span class="d-block">
             <label>Расчет площади
                <small>Несколько в гурппе - input type="number"</small>
            </label>
            <input type="checkbox" name="is_area" <?=valueIf($isArea=='on', 'checked') ?>>
        </span>
    </span>