<?
$mapDetailing = include FREECALC_INC.'view/partials/detailing-classes.php';
$count = 1;
?>
<style>
    table{
        font-family: Arial, sans-serif;
        width: 100%;
    }
    tr{
    }
    tr td{
        width: 20%;
        border-bottom: 1px dashed #BABABA;
        padding: 8px 0;
        margin: 0;
    }
    tr:first-child td:last-child{
        width: 40%;
    }
    tr td:first-child{
        width: 60%;
    }
    tr td:last-child{
        text-align: right;
    }
</style>

<table width="100">
	<? foreach ($mapDetailing as $key=>$item):
	if($item['display']==='none')
		continue; ?>
      <tr>
         <td>
           <?= $item['name']?>:</td>

         <? if ($item['def_price']): // Для материала?>
            <td style="text-align:center;"><?= $item['def_prop']?></td>
            <td><?= $item['def_price']?></td>
         <? else: ?>
            <td colspan="2"><?= $item['def_prop']?></td>
         <? endif;?>
      </tr>
	 <? $count++; endforeach; ?>
</table>

<!--<div class="freecalc__detailing">
	<h2 class="freecalc__detailing-header">Детализация:</h2>
	<?/* foreach ($mapDetailing as $key=>$item):
		if($item['display']==='none')
			continue; */?>

		<div class="detailing <?/*= $key */?>">
			<div class="detailing__text"><?/*= $item['name'] */?>: </div>
			<div class="detailing__prop"><?/*= $item['def_prop'] */?></div>
			<?/* if ($item['def_price']): */?>
				<div class="detailing__price"><?/*= $item['def_price'] */?></div>
			<?/* endif; */?>
		</div>
	<?/* endforeach; */?>
</div>-->
