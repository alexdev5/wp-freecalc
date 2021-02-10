<?
/*
 * Если находимся на странице редактирования
   $data - текущий калькулятор
   $data -> id
   $data -> calcname
   $data -> content - компоненты
   $data -> settings - общие настройки
*/
?>

<!-- end -->

<div class="<?= valueIf(is_admin(), 'calc-column adding widgets-holder-wrap padding col-12 column') ?> freecalc-column freecalc-column-<?= $comp['column-id'] ?> <?= valueIf($comp['column-id']==1&&!is_admin(), 'active') ?>"
     data-id="<?= $count ?>"
     data-component="column" <?=valueIf($compSett['custom-style']&&!is_admin(), "style='".$compSett['custom-style']."'")?>>

   <? if (is_admin()): ?>
      <!-- Удалить колонку -->
      <div class="deleted" title="Удалить колонку">
         <i class="fas fa-trash"></i>
      </div>
      <!-- $comp - текущий компонент -->
      <!-- $adata - data-attribute.
       Значение дата отрибута, все == значениям data, кроме data-text -->

   <!-- end deleted column -->
   <div class="column-top">

      <input data-text class="column-name" data-name="column" value="<?= valueIf($comp['name'], '', "Имя колонки") ?>" >
         <span class="slide">
            <i class="far fa-minus"></i>
         </span>
   </div>

   <? endif; ?>

   <!-- group -->
	<?= fis_admin('<div class="content">') ?>
      <? /* $comp - текущий компонент */
         if ($compsNext){
             $count = 1;
             foreach ($compsNext as $item) {
                 $item['column-id'] = $comp['column-id'];
                 $item['group-id'] = $count;
                echo view2($item['component'],
                  [
                   'compsNext'=>$item['nested'],
                   'name'=>$item['component'],
                    'comp'=>$item,
                     'adata'=>$item['data'],
                    'compSett'=>$item['settings'],
                  ]
                );
             $count ++;
             }
         }
         else{
             include FREECALC_INC . 'view/components/group.php';
         }
      ?>
	<?= fis_admin('</div>') ?>

   <!-- end group -->
   <? if (is_admin()): ?>
      <!-- Добавить колонку -->
      <? /* Кнопка должна лежать в .adding */ ?>
      <button type="button" class="btn btn-light btn-green add-group" title="Добавить группу">
         <i class="fal fa-object-group"></i>
      </button>
   <? endif; ?>
</div>