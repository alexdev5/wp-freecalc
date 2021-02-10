<? ?>

<div class="freecalc__detailing widgets-holder-wrap padding col-12">
	<h3 class="detailing__header">Детализация:</h3>

	<div class="detailing-block <?= fis_admin('adding') ?>">

	</div>

	<button type="button" class="btn btn-yellow add-detal" title="Добавить елемент">
		<i class="fal fa-plus-square"></i>
	</button>

	<div class="template-detal ds-none">
		<div class="detailing material-js <?= fis_admin('adding') ?>">
			<? if (is_admin())
				include FREECALC_INC . 'view/partials/btn-del-elem.php';?>

			<div class="detailing__text" <?= fchangeText() ?>>Наименование строки</div>
			<div class="detailing__prop" <?= fchangeText() ?>>Значение по умолчанию</div>
			<div class="detailing__price" <?= fchangeText() ?>>Значение по умолчанию</div>
		</div>
	</div>

</div>
