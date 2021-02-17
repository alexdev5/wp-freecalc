
<!-- freecalc block -->
<div class="freecalc">
   <h2 class="freecalc__title">Выберите тип изделия:</h2>
   <span type="hidden" class="settings-calc ds-none"><?
     $settings['balrate_usd']=get_option('balrate_usd');
     echo json_encode($settings) ?></span>
   <ul class="freecalc-tabs row ai-center">
      <? $count = 1;
      foreach ($contents as $item_1): ?>
         <li class="freecalc-tab freecalc-tab-<?= $count ?> <? if ($count===1) echo 'active';?>" data-name="column_<?= $count ?>" data-id="<?= $count ?>">
            <span class="freecalc-tab__link">
               <?= $item_1['name'] ?>
            <span class="freecalc-tab__arrow">
               <svg width="42" height="24" viewBox="0 0 42 24" version="1.1" xmlns="http://www.w3.org/2000/svg"> <g transform="translate(-524 -365)"> <path transform="translate(316 300)" fill="#6B6B6B" d="M 20 70L 20 65C 19.9698 65 19.9395 65.0003 19.9093 65.0008L 20 70ZM 211 70L 214.293 66.2379C 213.382 65.4399 212.212 65 211 65L 211 70ZM 225.706 82.874L 222.413 86.6361C 222.441 86.6611 222.47 86.6859 222.499 86.7102L 225.706 82.874ZM 231.992 82.874L 235.199 86.7102C 235.215 86.6966 235.232 86.6828 235.248 86.669L 231.992 82.874ZM 247 70L 247.01 65C 245.812 64.9977 244.653 65.4253 243.745 66.205L 247 70ZM 437.044 70.3628L 437.034 75.3628L 437.044 75.3628L 437.044 70.3628ZM 457 50.2449L 452 50.2449L 452 50.2449L 457 50.2449ZM 437.044 -5L 19.9563 -5L 19.9563 5L 437.044 5L 437.044 -5ZM 19.9563 -5C 14.084 -5 9.34798 -3.50513 5.63008 -1.00645C 1.94547 1.46985 -0.444882 4.7326 -1.98477 7.83732C -3.51539 10.9233 -4.25572 13.9482 -4.62122 16.159C -4.80594 17.2763 -4.9002 18.2182 -4.94852 18.9001C -4.97274 19.242 -4.98559 19.5209 -4.9924 19.7268C -4.9958 19.8298 -4.9977 19.9147 -4.99875 19.9803C -4.99928 20.0131 -4.99959 20.041 -4.99977 20.064C -4.99986 20.0755 -4.99992 20.0858 -4.99995 20.0948C -4.99997 20.0993 -4.99998 20.1035 -4.99999 20.1073C -4.99999 20.1092 -5 20.1119 -5 20.1129C -5 20.1155 -5 20.118 0 20.118C 5 20.118 5 20.1203 5 20.1226C 5 20.1232 4.99999 20.1254 4.99999 20.1268C 4.99999 20.1294 4.99998 20.1318 4.99997 20.1338C 4.99996 20.1379 4.99994 20.1409 4.99992 20.1427C 4.99989 20.1464 4.99988 20.1455 4.99997 20.1402C 5.00014 20.1297 5.00067 20.1016 5.00214 20.0573C 5.00508 19.9684 5.01172 19.8152 5.02647 19.6069C 5.05611 19.1887 5.11776 18.5589 5.24485 17.7901C 5.50299 16.2287 6.00993 14.2241 6.97385 12.2806C 7.92851 10.3559 9.27996 8.58913 11.2081 7.29331C 13.1029 6.01987 15.8505 5 19.9563 5L 19.9563 -5ZM -5 20.118L -5 50.2449L 5 50.2449L 5 20.118L -5 20.118ZM -5 50.2449C -5 56.1422 -3.52025 60.888 -1.02727 64.6043C 1.44617 68.2915 4.70994 70.6586 7.81878 72.1658C 10.9059 73.6625 13.9294 74.3575 16.1357 74.6874C 17.2512 74.8542 18.1915 74.9325 18.8725 74.9691C 19.2138 74.9874 19.4926 74.9954 19.6985 74.9986C 19.8015 75.0002 19.8865 75.0005 19.9522 75.0004C 19.9851 75.0004 20.0132 75.0002 20.0363 74.9999C 20.0479 74.9998 20.0582 74.9997 20.0673 74.9996C 20.0718 74.9995 20.076 74.9994 20.0799 74.9994C 20.0819 74.9993 20.0846 74.9993 20.0855 74.9993C 20.0882 74.9992 20.0907 74.9992 20 70C 19.9093 65.0008 19.9117 65.0008 19.914 65.0007C 19.9147 65.0007 19.9169 65.0007 19.9183 65.0007C 19.9209 65.0006 19.9233 65.0006 19.9255 65.0006C 19.9297 65.0005 19.9328 65.0005 19.9347 65.0004C 19.9386 65.0004 19.938 65.0004 19.933 65.0004C 19.9231 65.0005 19.8958 65.0004 19.8523 64.9998C 19.7652 64.9984 19.6143 64.9945 19.4088 64.9835C 18.996 64.9613 18.3738 64.9109 17.6143 64.7973C 16.0706 64.5665 14.0941 64.0949 12.1812 63.1675C 10.2901 62.2507 8.55383 60.9364 7.27727 59.0334C 6.02025 57.1596 5 54.4065 5 50.2449L -5 50.2449ZM 20 75L 211 75L 211 65L 20 65L 20 75ZM 207.707 73.7621L 222.413 86.6361L 229 79.1119L 214.293 66.2379L 207.707 73.7621ZM 222.499 86.7102C 226.152 89.7632 231.547 89.7632 235.199 86.7102L 228.786 79.0377C 228.811 79.0168 228.833 79.0062 228.845 79.0021C 228.855 78.9987 228.855 79 228.849 79C 228.843 79 228.844 78.9987 228.853 79.0021C 228.865 79.0062 228.888 79.0168 228.913 79.0377L 222.499 86.7102ZM 235.248 86.669L 250.255 73.795L 243.745 66.205L 228.737 79.079L 235.248 86.669ZM 246.99 75L 437.034 75.3628L 437.053 65.3628L 247.01 65L 246.99 75ZM 437.044 75.3628C 442.916 75.3628 447.652 73.8679 451.37 71.3693C 455.055 68.893 457.445 65.6302 458.985 62.5255C 460.515 59.4395 461.256 56.4146 461.621 54.2039C 461.806 53.0866 461.9 52.1447 461.949 51.4627C 461.973 51.1209 461.986 50.8419 461.992 50.636C 461.996 50.533 461.998 50.4481 461.999 50.3826C 461.999 50.3498 462 50.3218 462 50.2988C 462 50.2873 462 50.277 462 50.2681C 462 50.2636 462 50.2594 462 50.2555C 462 50.2536 462 50.2509 462 50.2499C 462 50.2474 462 50.2449 457 50.2449C 452 50.2449 452 50.2425 452 50.2402C 452 50.2396 452 50.2374 452 50.2361C 452 50.2334 452 50.2311 452 50.229C 452 50.2249 452 50.2219 452 50.2201C 452 50.2164 452 50.2173 452 50.2226C 452 50.2332 451.999 50.2612 451.998 50.3056C 451.995 50.3944 451.988 50.5476 451.974 50.7559C 451.944 51.1742 451.882 51.804 451.755 52.5727C 451.497 54.1341 450.99 56.1387 450.026 58.0822C 449.071 60.007 447.72 61.7737 445.792 63.0695C 443.897 64.343 441.15 65.3628 437.044 65.3628L 437.044 75.3628ZM 462 50.2449L 462 20.118L 452 20.118L 452 50.2449L 462 50.2449ZM 462 20.118C 462 14.2218 460.524 9.46667 458.052 5.72925C 455.6 2.02115 452.363 -0.392206 449.272 -1.95013C 446.202 -3.49776 443.191 -4.24671 440.99 -4.61654C 439.878 -4.80344 438.94 -4.89885 438.26 -4.94779C 437.92 -4.97233 437.641 -4.98536 437.436 -4.99227C 437.333 -4.99572 437.248 -4.99766 437.182 -4.99873C 437.149 -4.99926 437.121 -4.99958 437.098 -4.99976C 437.087 -4.99986 437.076 -4.99991 437.067 -4.99995C 437.063 -4.99997 437.058 -4.99998 437.054 -4.99999C 437.053 -4.99999 437.05 -5 437.049 -5C 437.046 -5 437.044 -5 437.044 0C 437.044 5 437.041 5 437.039 5C 437.038 5 437.036 4.99999 437.035 4.99999C 437.032 4.99999 437.03 4.99998 437.027 4.99997C 437.023 4.99995 437.02 4.99993 437.018 4.99992C 437.014 4.99989 437.015 4.99987 437.02 4.99995C 437.029 5.00011 437.057 5.00064 437.1 5.00209C 437.187 5.00501 437.337 5.01162 437.542 5.02638C 437.954 5.05602 438.575 5.11778 439.333 5.24523C 440.874 5.50408 442.853 6.0125 444.771 6.97963C 446.67 7.93644 448.422 9.2952 449.711 11.2453C 450.982 13.166 452 15.9552 452 20.118L 462 20.118Z"></path> </g> </svg>
            </span>
            </span>
         </li>
      <? $count++; endforeach; $count=1?>
   </ul>
    <?
 // $contents - Приходит с шорткода: includes/classes/class.shortcode.php

		if ($contents){
        foreach ($contents as $item) {
            $item['column-id'] = $count;
            echo view2($item['component'],
                ['compsNext'=>$item['nested'],
                    'comp'=>$item,
                    'count'=>$count,]);
					$count++;
        }
    }
    ?>

    <!-- Детализация проекта -->
  <!-- square-big-with-img -->

   <h2 class="freecalc__detailing-header">Детализация:</h2>

   <!-- Столешницы -->
   <div class="freecalc__detailing detailing-1 active">
		 <? $detailing_worktop = include FREECALC_INC.'view/partials/detailing-classes.php' ?>
      <? foreach ($detailing_worktop as $key=>$item):
        if($item['display']==='none')
           continue; ?>
         <div class="detailing <?= $key ?>">
            <div class="detailing__text"><?= $item['name'] ?>: </div>
            <div class="detailing__prop"><?= $item['def_prop'] ?></div>
            <? if ($item['def_price']): ?>
            <div class="detailing__price"><?= $item['def_price'] ?></div>
            <? endif; ?>
         </div>
      <? endforeach; ?>
   </div>

   <!-- В ванную -->
   <div class="freecalc__detailing detailing-2">
		 <? $detailing_worktop = include FREECALC_INC.'view/partials/detailing-bathroom.php' ?>
		 <? foreach ($detailing_worktop as $key=>$item):
			 if($item['display']==='none')
				 continue; ?>
        <div class="detailing <?= $key ?>">
           <div class="detailing__text"><?= $item['name'] ?>: </div>
           <div class="detailing__prop"><?= $item['def_prop'] ?></div>
					<? if ($item['def_price']): ?>
             <div class="detailing__price"><?= $item['def_price'] ?></div>
					<? endif; ?>
        </div>
		 <? endforeach; ?>
   </div>


   <!-- Подоконники -->
   <div class="freecalc__detailing detailing-3">
		 <? $detailing_worktop = include FREECALC_INC.'view/partials/detailing-windowsill.php' ?>
		 <? foreach ($detailing_worktop as $key=>$item):
			 if($item['display']==='none')
				 continue; ?>
        <div class="detailing <?= $key ?>">
           <div class="detailing__text"><?= $item['name'] ?>: </div>
           <div class="detailing__prop"><?= $item['def_prop'] ?></div>
					<? if ($item['def_price']): ?>
             <div class="detailing__price"><?= $item['def_price'] ?></div>
					<? endif; ?>
        </div>
		 <? endforeach; ?>
   </div>


   <div class="freecalc__promocode">
      <p class="ta-center">Если вы являетесь нашим партнером, введите Ваш персональный промокод</p>
      <div class="form-group">
         <input type="text" class="form-control promocode-text">
         <button class="button-one success">Применить</button>
      </div>
   </div>

   <!-- footer -->
   <div class="freecalc__footer">
      <h2>Итого: </h2>
      <div class="total-sum fixed">
         <span class="sum c-red">0</span>
         <span class="cur1r">р.</span>
      </div>
      <div class="total-sum">
         <span class="sum c-red"></span>
         <span class="curr"></span>
      </div>
   </div>

   <div class="calc-actions__tabs">
      <div class="calc-actions__tab">
         <button class="calc-action" name="save">Сохранить</button>
      </div>
      <div class="calc-actions__tab">
         <button class="calc-action" name="send">
            <i class="fal fa-paper-plane"></i>Отправить нам
         </button>
      </div>
      <div class="calc-actions__tab">
         <button class="calc-action" name="print">
            <i class="fal fa-print"></i>Печать
         </button>
      </div>
   </div>
</div>
<!-- end freecalc block -->

<!-- modal send -->
<template class="f-modal-send">
        <div class="close">x</div>
        <div class="caption">Отправить нам расчет</div>
        <form class="content">
            <input type="text" name="name" value="" placeholder="Имя" required>
            <input type="text" name="tel" value="" placeholder="Телефон" required>
            <p class="f-regular">Нажимая «Отправить », вы даете согласие на
                <br>
                обработку персональных данных в соответствии с
                <br>
                <a href="/politic/">политикой конфиденциальности</a> и принимаете
                <br>
                <a href="/polzovatelskoe-soglashenie/">условия пользовательского соглашения</a>. </p>
            <button type="submit" name="sumbit_request">Отправить</button>
        </form>
</template>