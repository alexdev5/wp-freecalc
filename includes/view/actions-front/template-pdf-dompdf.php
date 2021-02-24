<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Расчет изделия</title>

    <?
		/* Подключение стилей */
		include FREECALC_INC . 'view/actions-front/template-pdf-styles.php';
		/* ------------------- */
    ?>
</head>
<body>

<?

//var_dump_pre($_SERVER);
$details['column_id'] = 'test';
$details['column_id'] = 1;
$radials = [0,0,0,0,5, 0];
$data['cpanel'] = true;
$data['wimg'] = 'worktop-g';

$size['w1'] = 1000;
$size['w2'] = 2000;
$size['w3'] = 2000;
$size['l1'] = 1000;
$size['l2'] = 2000;
$size['l3'] = 2000;
/*$img = FREECALC_URL.'admin/img/worktop/'.$data['wimg'].'.jpg';*/

?>

<?
if ($details['column_id']==1)
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-classes.php';
elseif ($details['column_id']==2)
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-bathroom.php';
elseif ($details['column_id']==3)
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-windowsill.php';
elseif ($details['column_id']=='test')
	$mapDetailing = include FREECALC_INC.'view/partials/detailing-test.php';

$radials = $data['radial'];
// $data['wname'] - имя столешницы
/*print_r_pre($_SERVER);*/
?>


<!-- Шапка документа -->
<!--<p><?/* print_r_pre($details); */?></p>-->
<table class="header">
    <tr>
        <td>
            <div class="logo">
                  <span class="logo-img">
                      <img src="<?= getImgBase64(FREECALC_PATH.'front/img/logo.jpg') ?>" alt="">
                  </span>
                <span class="logo-text">Vaskaniya</span>
                <small>КОГДА ВАЖНО КАЧЕСТВО</small>
            </div>
        </td>
        <td>
            <p>tel: <b>+7</b>(343) 346-76-55</p>
            <!--<p>e-mail: info@vaskaniya.ru</p>-->
            <p>г. Екатеринбург, ул. Толедова 43Б</p>
            <p><a href="<?= get_home_url() ?>"><?= $_SERVER['HTTP_HOST'] ?></a></p>
        </td>
    </tr>
</table>


<div class="footer">
    <div class="footer-left">+7 (343) 346-76-55</div>
    <div class="footer-right">info@vaskaniya.ru</div>
</div>

<div class="wrapper">
    <p class="header-text <?= 'text-'.$data['wimg'] ?>">Предварительный расчет стоимости</p>


    <!-- Картинка клалькулятора -->
    <? $img = FREECALC_PATH.'admin/img/worktop/'.$data['wimg'].'.svg';
    ?>
    <!-- Тест -->

    <div class="worktop-static">
        <? if ($data['wimg']): ?>
           <div class="worktop <?= $data['wimg'] ?>">
              <?= file_get_contents($img) ?>
               <!--<img src="<?/*= $img */?>">-->
               <!--<img width="688" src="<?/*= getImgBase64($img); */?>">-->

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
    </div>

    <table class="detail-add">
        <!-- 1 -->
        <tr>
           <td>
              <div class="detail-add__text">Материал</div>
              <div class="detail-add__block">
                 <div class="add-img">img</div>
                 <div class="add-text">text</div>
              </div>
           </td>
           <!-- 2 -->
           <td>
              <div class="detail-add__text">Выбраный тип мойки</div>
              <div class="detail-add__block">
                 <div class="add-img">img</div>
                 <div class="add-text">text</div>
              </div>
           </td>
           <!-- 3 -->
           <td>
              <div class="detail-add__text">Фаска</div>
              <div class="detail-add__block">
                 <div class="add-img">img</div>
                 <div class="add-text">text</div>
              </div>
           </td>
        </tr>
    </table>

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
    <div>
       <table class="total">
          <tr>
             <td>
               <? if ($data['promocode']) echo "Промокод: <span class='c-red'>{$data['promocode']}</span>" ?>
             </td>
             <td></td>
             <td><div class="total-sum">Итого: <span class="c-red"><?= $total ?></span> p.</div>
             </td>
          </tr>
       </table>

    </div>


    <div class="text-after-calc">
        <?=  htmlspecialchars_decode($calcSetting['text-editor']) ?>
    </div>
</div>


</body>
</html>