<?
$mapDetailing = include FREECALC_INC.'view/partials/detailing-classes.php';
$count = 1;
?>
<style>
   *{
      font-family: Arial, sans-serif;
   }
    table{
      width: 100%;
      border-collapse: collapse;
    }
    table p{
       margin: 0;
    }
    table h2{
       font-weight: normal;
       font-size: 18px;
       margin: 0;
    }
    small{
       font-size: 60%;
    }
    .ib{
       display: inline-block;
    }
    .bdb{
       border-bottom: 1px solid #393939 !important;
    }
    .mb40{
       margin-bottom: 40px;
    }
    .mb20{
       margin-bottom: 20px;
    }
    .tt-upper{
       text-transform: uppercase;
    }
    .c-green{
       color: #589F14;
    }
    .c-red{
       color: red;
    }


    /* Шапка документа */
    .header{
       margin-bottom: 60px;
    }
    .header td{
       background: #393939;
       height: 90px;
       width: 33.33333%;
       vertical-align: middle;
       color: #fff;
       padding: 15px;
    }
    .header td:last-child{
       text-align: right;
       width: 40%;
    }
    .header td p{
       font-size: 12px;
    }


    /* Шапка калькулятора */
    .calculation-header{
       margin-bottom: 40px;
    }
    h2{
       font-weight: normal;
       font-size: 18px;
       margin: 0;
       text-transform: uppercase;
    }

    /* Расчет */
    .calculation tr td{
        width: 20%;
        border-bottom: 1px solid #393939;
        padding: 8px 0;
        margin: 0;
    }
    .calculation tr:first-child td:last-child{
        width: 40%;
    }
    .calculation tr td:first-child{
        width: 60%;
    }
    .calculation tr td:last-child{
        text-align: right;
    }

   /* Total */
   .total{
      text-align: right;
      margin-top: 30px;
      display: block;
   }
   .total > *{
      vertical-align: middle;
   }
   .total h2{
      display: inline-block;
      font-size: 32px;
      font-weight: 500;
   }
   .total .total-sum{
      font-size: 32px;
      font-weight: 500;
      margin-left: 30px;
   }
   .to-lower{
      text-transform: lowercase;
   }
   .calculation-img{
      margin-top: 30px;
   }
   .calculation-img img{
      background: #000;
     /* width: 900px;*/
      max-height: 300px;
   }
</style>


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
      <h2 class="bdb ib"><?= $details['worktop_name'] ?> столешницa</h2>
   </div>

	<? if ($details['worktop_imgname']):
     $img = FREECALC_PATH.'admin/img/worktop/'.$details['worktop_imgname'].'.jpg'
     ?>
     <div class="calculation-img">
        <img src="<?= $img ?>">
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
$total = htmlspecialchars_decode($details['total_price']);
?>
<div class="total">
   <div class="total-sum">Итого: <?= $total ?></div>
</div>