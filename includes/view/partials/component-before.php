<?
/*
 * $comp, $name, $compSett - приходит с настройки компонента
 * */

$toPrice = $compSett['other-price'];
$class_active = valueIf($comp['id']==1, ' active');
$classes = $name
	. ' '
	. fis_admin(' adding')
	. valueIf($compSett['for-detailing'], ' detailing-js')
	. valueIf($compSett['add-class']&&!is_admin(), ' '.$compSett['add-class']);


$dataset = ' data-component="' .$name. '"'
	// Для детализации
	. valueIf($compSett['for-detailing'], 'data-for-detailing="' . $compSett['for-detailing'] . '" ')
	. valueIf($compSett['connection']&&!is_admin(), 'data-connect-group="'.$compSett['connection'].'" ') ;

/* группа элементов */
if ($name == 'group-block'){
	$idGroup = $name.':'
		.$comp['column-id'].':'
		.$comp['group-id'].':'
		.$comp['group-block-id']
		.valueIf($comp['id'], ':'.$comp['id']);

	$classes .= ' row'
		.fis_admin(' component')
		. valueIf($compSett['is_area']==='on', ' calc-area')
		. valueIf($compSett['align-elements']=='fd-column',' fd-column')
		. valueIf($compSett['connection-name']&&!is_admin(), ' visible-for-components visible__'.$compSett['connection-name'])
		. valueIf($compSett['isnt_add_price']=='on'&&!is_admin(), ' isnt-add-price') ;

	$styles = valueIf(!is_admin()&&$compSett['align-elements'],  'justify-content:'.$compSett['align-elements'].';'. valueIf($compSett['custom-style']&&!is_admin(), $compSett['custom-style']));

	$dataset .= ' data-name="' .$idGroup. '"';
}
else{
	// отдельный компонент

	$nameCheck = $name.':'.$comp['column-id'].':'
		.$comp['group-id'].':'
		.$comp['group-block-id'].':'
		.$comp['component-id'];

	$styles = valueIf($compSett['custom-style']&&!is_admin(), " style='".$compSett['custom-style']."'");
	$dataset .=
	// Для умножения на цену, если она выбрана у другого компонента
	valueIf($toPrice['cid'], 'data-cid="'.$toPrice['cid'].'" ')
	. valueIf($toPrice['cname'], 'data-cname="'.$toPrice['cname'].'" ')
	. valueIf($toPrice['cclass'], 'data-cclass="'.$toPrice['cclass'].'" ') ;

	//var_dump_pre($toPrice);
	$classes .= ' component'
		. valueIf($compSett['connection']&&!is_admin(), ' connect-element');
}
?>