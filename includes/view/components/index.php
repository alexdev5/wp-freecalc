<div class="template freecalc">
   <?/* include FREECALC_INC . 'view/components/group.php'; */?>
   <? include FREECALC_INC . 'view/components/column.php'; ?>

   <div class="components">
      <? foreach ($components as $key=>$name):
         include FREECALC_INC . 'view/components/'.$name.'.php';
      endforeach; ?>
   </div>

   <!-- Window checked elements -->
   <div class="popup-template ">
      <h2 class="ta-center padding">Выберите элемент</h2>

      <div class="row components">
         <? /* $components - c контроллера AdminController->getTypeComponents */
         foreach ($components as $key=>$name): ?>
            <div class="col-4" data-components="<?= $name; ?>" style="background-image:url(<?= FREECALC_URL.'admin/img/components/'.$name.'.png'; ?>);">
                <span><?= $name; ?></span>
            </div>
         <? endforeach; ?>
      </div>
   </div>
</div>