<?
$map = include FREECALC_INC.'view/partials/detailing-classes.php';
?>
<span class="d-block">
		<label class="d-block">Для детализации
         <small>В какой строке выводить информацию</small>
      </label>
		<select name="for-detailing" class="for-detailing">
			<option value="">-----</option>
			<? foreach ($map as $key=>$item):
           $len = mb_strlen($item['name'])?>
				<option value="<?= $key ?>" <?= valueIf($forDetailing===$key, 'selected') ?>>
					<? if ($len>30)
					      echo mb_substr($item['name'], 0, 30).'...';
                  else
                     echo mb_substr($item['name'], 0, 30) ?>
				</option>
			<? endforeach; ?>
      </select>
</span>