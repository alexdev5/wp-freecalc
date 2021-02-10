<?

//$nameCheck = $name.':'.$comp['id'];
$typeInput = valueIf($group['component-type'], '', $compSett['component-type']);
$typeInput = valueIf($typeInput, '', 'checkbox');

$nameCheck = $name.':'.$comp['column-id'].':'
          .$comp['group-id'].':'
          .$comp['group-block-id'].':'
          .$comp['component-id'];
$nameRadio = 'group:'.$comp['column-id'].':'
          .$comp['group-id'].':'
          .$comp['group-block-id'];

$toPrice = $compSett['other-price'];
?>

<input type="<?= $typeInput ?>"
       class="dot reg-calc"
       name="<?= valueIf($typeInput==='checkbox', $nameCheck, $nameRadio) ?>"
       data-price="<?= $compSett['price'] ?>" id="<?= $nameCheck ?>"
       data-price-type="<?= $compSett['price-type'] ?>"
       <?= valueIf($compSett['select-action'], 'data-action="'.$compSett['select-action'].'"')
       . valueIf($compSett['is_show_action_detail']=='on', 'data-showaction="on" ')?> >
<? if ($isSpan !== false): ?>
   <span class="checked"></span>
<? endif; ?>