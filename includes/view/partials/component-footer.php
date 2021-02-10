<!-- $compSett | Указать цену с другого компонента -->
<?= view2('settings/check-component-price', [
        'otherPrice'=>$compSett['other-price'] ]); ?>
<? //print_r_pre($compSett); ?>
<!-- $style | Свои стили -->
<?= view2('settings/custom-styles', [ 'style'=>$compSett['custom-style'] ]); ?>

<!-- Кнопка "ОК" -->
<?= view2('settings/btn-ok'); ?>
<!-- end -->