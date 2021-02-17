<?
if ($details['column_id']==1)
   $mapDetailing = include FREECALC_INC.'view/partials/detailing-classes.php';
elseif ($details['column_id']==2)
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-bathroom.php';
elseif ($details['column_id']==3)
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-windowsill.php';

/* Подключение стилей */
include FREECALC_INC . 'view/actions-front/template-pdf-styles.php';
/* ------------------- */
?>

<?

$radials = $data['radial'];
// $data['wname'] - имя столешницы
?>


<!-- Шапка документа -->
<!--<p><?/* print_r_pre($details); */?></p>-->
<table class="header">
   <tr>
      <td>
          <div class="logo">
              <span class="logo-img">
                  <img src="<?= FREECALC_PATH.'front/img/logo.jpg'; ?>" alt="">
              </span>
              <span class="logo-text">Vaskaniya</span>
              <small>КОГДА ВАЖНО КАЧЕСТВО</small>
          </div>
      </td>
      <td>
        <p>tel: <b>+7</b>(343) 346-76-55</p>
        <p>e-mail: info@vaskaniya.ru</p>
        <p><a href="https://столешница96.рф">https://столешница96.рф</a></p>
        <p>г. Екатеринбург, ул. Толедова 43Б</p>
      </td>
   </tr>
</table>


<!-- Картинка клалькулятора -->
<?

 /*$radials = [0,0,0,0,5, 0];
 $data['cpanel'] = true;*/
 /*$data['wimg'] = 'windowsill-mirrored';

 $size['w1'] = 1000;
 $size['w2'] = 2000;
 $size['w3'] = 2000;
 $size['l1'] = 1000;
 $size['l2'] = 2000;
 $size['l3'] = 2000;*/

 $img = FREECALC_PATH.'admin/img/worktop/'.$data['wimg'].'.jpg';
 //$img = FREECALC_URL.'admin/img/worktop/'.$data['wimg'].'.jpg';

?>
<!-- Тест -->

<? if ($data['wimg']): ?>
   <div class="worktop <?= $data['wimg'] ?>">
      <img src="<?= $img ?>">
      <? if (count($radials)>0): ?>
         <? foreach ($radials as $key=>$is_radial) {
             $i = $key+1;
            echo "<span class='check-radial check-mark-{$i} ".valueIf($is_radial>0, 'checked')."'></span>";
         }?>
          <span class="check-panel <?= valueIf($data['cpanel']==1, 'checked') ?>"></span>
      <? endif; ?>

       <? foreach ($size as $sname=>$val){
           echo "<span class='size {$sname}'>{$val}</span>";
       } ?>
   </div>
<? endif; ?>


<!-- Калькулятор -->
<h2 class="detailing-header">Детализация</h2>
<table class="detailing">

    <tr>
        <th>№ <br>п/п</th>
        <th>Наименование работ</th>
        <th>Едица <br>измерения</th>
        <th>Цена, руб</th>
    </tr>
   <!-- Расчет -->
	<? $count = 1;
	foreach ($mapDetailing as $key=>$item):
	if($item['display']==='none')
		continue;
	// $item['def_price']
	$prop = htmlspecialchars_decode($details[$key]['prop']);
	$price = htmlspecialchars_decode($details[$key]['price']);
     ?>
      <tr>
         <td><?= $count ?></td>
         <td><?= $item['name']?>:</td>
         <td style="text-align:center;"><?= valueIf($count==1, ' ', $prop) ?></td>
         <td><?=  valueIf($count==1, '<span class="c-red">'.$prop.'</span>', $price)?></td>
      </tr>
	 <? $count++; endforeach; ?>
</table>

<?
$total = htmlspecialchars_decode($data['total_price']);
?>
<div class="total">
   <div class="total-sum">Итого: <span class="c-red"><?= $total ?></span> p.</div>
</div>