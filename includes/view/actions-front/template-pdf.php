<?
$mapDetailing = include FREECALC_INC.'view/partials/detailing-classes.php';
$count = 1;

/* Подключение стилей */
include FREECALC_INC . 'view/actions-front/template-pdf-styles.php';
/* ------------------- */
?>

<?

$radials = $data['radial'];
?>


<!-- Шапка документа -->
<!--<p><?/* print_r_pre($details); */?></p>-->
<table class="header">
   <tr>
      <td>logo</td>
      <td class="tt-upper">
         <p>Изделия</p>
         <p>Из искуственного камня</p>
         <p>От компании "Стайл Стоун"</p>
      </td>
      <td>
         <small>140070, МО, Люберецкий район, п. Томилино, ул. Гоголя , д. 39/1 стр.1</small>
         <p class="c-green">+7 (495) 132-1190</p>
         <p class="c-green">+7 (495) 132-1190</p>
      </td>
   </tr>
</table>


<!-- Шапка калькулятора -->
<div class="calculation-header tt-upper">
   <h2>Калькулятор</h2>
   <div>
      <h2 class="bdb ib"><?= $data['wname'] ?> столешницa</h2>
   </div>


   <!-- Тест -->
   <?

	 /*$radials = [0,0,0,0,5];
	 $data['cpanel'] = true;
	 $data['wimg'] = 'worktop-g';

	 $size['w1'] = 1000;
	 $size['w2'] = 2000;
	 $size['l1'] = 1000;
	 $size['l2'] = 2000;*/

	 $img = FREECALC_PATH.'admin/img/worktop/'.$data['wimg'].'.jpg';
	 //$img = FREECALC_URL.'admin/img/worktop/'.$data['wimg'].'.jpg';

   ?>
   <!-- Тест -->

    <? if ($data['wimg']): ?>
       <div class="worktop <?= $data['wimg'] ?>">
          <img src="<?= $img ?>">
          <? foreach ($radials as $key=>$is_radial) {
              $i = $key+1;
             echo "<span class='check-radial check-mark-{$i} ".valueIf($is_radial>0, 'checked')."'></span>";
          }?>

           <span class="check-panel <?= valueIf($data['cpanel']==1, 'checked') ?>"></span>

           <? foreach ($size as $sname=>$val){
               echo "<span class='size {$sname}'>{$val}</span>";
           } ?>
       </div>
    <? endif; ?>
</div>


<!-- Калькулятор -->
<h2 class="mb20">Детализация</h2>
<table class="calculation">

   <!-- Расчет -->
	<? foreach ($mapDetailing as $key=>$item):
	if($item['display']==='none')
		continue;
	// $item['def_price']
	$prop = htmlspecialchars_decode($details[$key]['prop']);
	$price = htmlspecialchars_decode($details[$key]['price']);
     ?>
      <tr>
         <td>
           <?= $item['name']?>:</td>

         <? if ($item['def_price']): // Для материала?>
            <td style="text-align:center;"><?= $prop ?></td>
            <td><?= $price?></td>
         <? else: ?>
            <td colspan="2"><?= $prop?></td>
         <? endif;?>
      </tr>
	 <? $count++; endforeach; ?>
</table>

<?
$total = htmlspecialchars_decode($data['total_price']);
?>
<div class="total">
   <div class="total-sum">Итого: <?= $total ?></div>
</div>