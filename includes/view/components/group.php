<div class="group adding group-id-<?= $comp['group-id'] ?>" data-component="group" data-id="<?= $comp['group-id'] ?>">
	<? if (is_admin()): ?>

   <!-- Удалить блок -->
   <div class="group-action">
      <div class="draggable">
         <i class="fad fa-arrows"></i>
      </div>
      <div class="deleted" title="Удалить группу">
         <i class="fas fa-trash"></i>
      </div>
   </div>

   <!-- end deleted block -->
   <!-- $comp - текущий компонент -->
   <!-- $adata - data-attribute.
	 Значение дата отрибута, все == значениям data, кроме data-text -->
   <? endif; ?>

   <? if (is_admin()): ?>
      <input class="textarea name-group" data-name="group" value="<?= valueIf($comp['name'],'', 'Name group') ?>" >
   <? else: ?>
      <h2 class="name-group">
        <?= valueIf($comp['name'],'', 'Name group') ?>
      </h2>
   <? endif; ?>

   <!-- Container for components -->
	<?= fis_admin('<div class="content">') ?>
		 <?
		 if ($compsNext){
		     $count = 1;
			 foreach ($compsNext as $item) {
                 $item['column-id'] = $comp['column-id'];
                 $item['group-id'] = $comp['group-id'];
                 $item['group-block-id'] = $count;
				 echo view2($item['component'],
               [
                  'compsNext'=>$item['nested'],
                   'name'=>$item['component'],
                   'comp'=>$item,
                   'adata'=>$item['data'],
                  'compSett'=>$item['settings'],
                  'is_br'=>true,
               ]);
                 $count++;
			 }
		 }
		 ?>
	<?= fis_admin('</div>') ?>
   <!-- end components -->

   <? if (is_admin()): ?>
      <!-- Add element -->
      <button type="button" class="btn btn-light btn-green add-elem" title="Добавить елемент">
         <i class="fal fa-plus-square"></i>
      </button>

      <hr>
   <? endif; ?>
</div>