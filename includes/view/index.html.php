
<?/*
print_r_pre($data);
*/?>

<div class="wrap">
   <h1 class="wp-heading-inline">Список Калькуляторов</h1>
   <a href="<?php echo admin_url() . 'admin.php?page=' . $data['link_new'] ?>" class="page-title-action">Добавить новый</a>
</div>


<table class="wp-list-table widefat fixed striped table-view-list pages freecalc">
	<thead>
      <tr>
         <th class="manage-column column-title column-primary">
            <span>Заголовок</span>
         </th>

         <th class="manage-column column-title column-primary">
            <span>Шорт код</span>
         </th>
      </tr>
	</thead>

	<tbody>

   <? if ($data['all']): ?>

     <?php foreach( $data['all'] as $key => $item ) : ?>
		 <?php $content = maybe_unserialize( $item->content ); ?>
      <!-- calc item ... -->
      <tr class="iedit author-self level-0 post-25 type-page status-publish hentry">
         <td class="title column-title has-row-actions column-primary page-title">
            <strong>
               <a class="row-title" href="<?php echo admin_url() . 'admin.php?page=' . $data['link_edit'] .'&id='.$item->id ?>">
                 <?php echo $item->calcname; ?>
               </a>
            </strong>
            <div class="row-actions">
               <span class="edit"><a href="<?php echo admin_url() . 'admin.php?page=' . $data['link_edit'] .'&id='.$item->id ?>">Редактировать</a> | </span>
               <span class="trash">
                  <a href="#" data-id="<?php echo $item->id; ?>" class="remove-calc">Удалить</a> |
               </span>
               <span class="duplicate">
                  <a href="#" data-id="<?php echo $item->id; ?>" class="duplicate-calc">Дублировать</a>
               </span>
            </div>
         </td>
         <td><span>[free_calc id="<?php echo $item->id; ?>"]</span></td>
      </tr>
	 <?php endforeach; ?>
   <? else: ?>
      <tr class="no-items">
         <td class="colspanchange" colspan="2">Записей не найдено.</td>
      </tr>
   <? endif; ?>
	</tbody>

</table>