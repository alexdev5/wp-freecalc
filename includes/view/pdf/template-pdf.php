<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Расчет изделия</title>
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <?
		/* Подключение стилей */
		include FREECALC_INC . 'view/pdf/template-pdf-styles.php';
		/* ------------------- */
    ?>
</head>
<body class="body-<?= $data['wimg'] ?>">

<?

//var_dump_pre($_SERVER);
/*$details['column_id'] = 'test';
$details['column_id'] = 1;
$radials = [0,0,0,0,5,0];
$data['cpanel'] = true;
// 'windowsill-mirrored';
$data['wimg'] = 'worktop-p';

$size['w1'] = 1000;
$size['w2'] = 2000;
$size['w3'] = 2000;
$size['l1'] = 1000;
$size['l2'] = 2000;
$size['l3'] = 2000;
$data['promocode'] = 'WERWER';*/


/* variables */
$root_url = $_SERVER['DOCUMENT_ROOT'];
$domainName = get_site_url();
$hostName = $_SERVER['HTTP_HOST'];
$radials = $data['radial'];
$total = htmlspecialchars_decode($data['total_price']);
/* end var */

/*$img = FREECALC_URL.'admin/img/worktop/'.$data['wimg'].'.jpg';*/

if ($details['column_id']==1)
	$mapDetailing = include FREECALC_INC.'view/detailing-array/detailing-classes.php';
elseif ($details['column_id']==2)
	$mapDetailing = include FREECALC_INC.'view/detailing-array/detailing-bathroom.php';
elseif ($details['column_id']==3)
	$mapDetailing = include FREECALC_INC.'view/detailing-array/detailing-windowsill.php';
elseif ($details['column_id']=='test')
	$mapDetailing = include FREECALC_INC.'view/detailing-array/detailing-test.php';


?>


<!-- header -->
<table class="header">
   <tr>
      <td>
         <div class="logo">
                  <span class="logo-img">
                      <img src="<?= getImgBase64(FREECALC_PATH.'front/img/logo.jpg') ?>" alt="">
                  </span>
            <span class="logo-text">Vaskaniya
            <small>КОГДА ВАЖНО КАЧЕСТВО</small></span>
         </div>
      </td>
      <td>
         <!--<p>e-mail: info@vaskaniya.ru</p>-->
         <p><?= $calcSetting['address-company'] ?></p>
         <p><?= htmlspecialchars_decode($calcSetting['telephone-company']) ?></p>
         <p><a href="<?= get_home_url() ?>"><?= $_SERVER['HTTP_HOST'] ?></a></p>
      </td>
   </tr>
</table>
<!-- end header -->

<!-- 1 -->
<div class="bg-stamp">
   <img src="<?= FREECALC_URL.'admin/img/pdf/bg-stamp.svg' ?>" alt="">
	<?/*= file_get_contents(FREECALC_PATH.'admin/img/bg-stamp.svg') */?>
</div>

<!-- 1 -->
<div class="bg-stamp bg-stamp-2">
   <img src="<?= FREECALC_URL.'admin/img/pdf/bg-stamp.svg' ?>" alt="">
	<?/*= file_get_contents(FREECALC_PATH.'admin/img/bg-stamp.svg') */?>
</div>

<div class="wrapper freecalc">
    <h2 class="header-text <?= 'text-'.$data['wimg'] ?>">Предварительный расчет стоимости:</h2>


    <!-- Картинка клалькулятора -->
    <? $img = FREECALC_PATH.'admin/img/worktop/'.$data['wimg'].'.svg';
    ?>
    <!-- Тест -->

    <div class="worktop-comp <?= $data['wimg'] ?>">
        <? if ($data['wimg']): ?>
           <div class="worktop-comp__relative">
              <?= file_get_contents($img) ?>

              <? if (count($radials)>0): ?>
                 <? foreach ($radials as $key=>$is_radial) {
                     $i = $key+1;
                    echo "<span class='check-mark check-mark-{$i} ".valueIf($is_radial>0, 'checked')."'></span>";
                 }?>
                  <span class="check-mark check-panel <?= valueIf($data['cpanel']==1, 'checked') ?>"></span>
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
              <div class="detail-add__text">Материал:</div>
              <div class="detail-add__block">
                 <img src="<?= $data['material_img_url'] ?>" alt="">
                 <div class="add-text">
                    <span class="text"><?= $data['material_text'] ?></span>
                 </div>
              </div>
           </td>
           <!-- 2 -->
           <td>
              <div class="detail-add__text">Выбраный тип мойки:</div>
              <div class="detail-add__block">
                 <div class="add-img">
                    <img src="<?= $data['type_install_img'] ?>" alt="">
                 </div>
                 <div class="add-text"><?= htmlspecialchars_decode($data['type_install_text']) ?></div>
              </div>
           </td>
           <!-- 3 -->
           <td>
              <div class="detail-add__text">Фаска:</div>
              <div class="detail-add__block">
                 <div class="add-img">
                    <img src="<?= $data['face_img_url'] ?>" alt="">
                 </div>
                 <div class="add-text">
                    <?= $data['face_text']?>
                 </div>
              </div>
           </td>
        </tr>
    </table>

</div>

<!-- header -->
<table class="header">
   <tr>
      <td>
         <div class="logo">
                  <span class="logo-img">
                      <img src="<?= getImgBase64(FREECALC_PATH.'front/img/logo.jpg') ?>" alt="">
                  </span>
            <span class="logo-text">Vaskaniya
            <small>КОГДА ВАЖНО КАЧЕСТВО</small></span>
         </div>
      </td>
      <td>
         <!--<p>e-mail: info@vaskaniya.ru</p>-->
         <p>г. Екатеринбург, ул. Толедова 43Б</p>
         <p>tel: <b>+7</b>(343) 346-76-55</p>
         <p><a href="<?= get_home_url() ?>"><?= $_SERVER['HTTP_HOST'] ?></a></p>
      </td>
   </tr>
</table>
<!-- end header -->

<div class="wrapper">
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

   <table class="total">
      <tr>
         <td class="total-promo c-grey">
					 <? if ($data['promocode']) echo "Промокод: <span class='c-red'>{$data['promocode']}</span>" ?>
         </td>
         <td class="c-grey ta-center">
					 <? if ($data['promocode']) echo 'Стоимость указана с учетом Вашей скидки'?>
         </td>
         <td>
            <div class="total-sum">Итого: <span class="c-red"><?= $total ?></span> p.</div>
         </td>
      </tr>
   </table>

   <!-- Text -->
    <div class="text-after-calc">
        <?=  htmlspecialchars_decode($calcSetting['text-editor']) ?>
    </div>
</div>


</body>
</html>