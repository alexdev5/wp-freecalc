<!-- Если у компонента есть класс "set" -->
<?
//var_dump_pre($otherPrice);?>

<span class="d-block">
		<label>Умножить цену на..
			<small>Компонент от которог зависит цена</small>
		</label>
   <span class="row ai-center">
      <span
            data-name="other-price"
            data-cname="<?= $otherPrice['cname'] ?>"
            data-cid="<?= $otherPrice['cid'] ?>"
            data-cclass="<?= $otherPrice['cclass'] ?>"
            data-text
            class="set other-price-component"
            title="Будет умножаться на цену этого компонента">
         <?= $otherPrice['text'] ?>
      </span>
      <span class="empty-up">
         <i class="hred far fa-minus-octagon" title="Удалить связь"></i>
      </span>
   </span>

</span>