(function( $ ) {
	'use strict';

	if(!is_elem($('.freecalc')))
		return;

	/* start modal */
	let modal = startModal();

	/* Контейнер для колонок */
	let contentColumn = $('#content-column');

	/* Компоненты */
	let templates = $('.template');
	let components = $('.template .components');
	let componentsIcon = $('.popup-template .components');

	/* Форма с элементами для сохранения, редактирования */
	let formCalc = $('.form-change');
	let currentPageType = $('input.page-type').val();
	let currentPageURL = $('input.page-url').val();


	/* Click - добавить колонку */
	$('.add-column').on('click', function () {
		contentColumn.append(templates.find('.column').clone(true))
	});


	/* Click - добавить группу */
	formCalc.on('click', '.add-group', function (evt) {
		evt.preventDefault();
		let contentGroup = $(this).parents('.adding').find('> .content');
		contentGroup.append(templates.find('.group').clone(true))
	});


	/* Click - открыть popup для добавления элемента */
	let lastContentElem = null;
	formCalc.on('click', '.add-elem', function () {
		lastContentElem = $(this).parent().find('> .content');
		modal.open();
	});


	/* Click - добавить элемент */
	componentsIcon.on('click', '>div', function () {
		let componentName = $(this).data('components');
		let component = components.find('> .'+componentName);

		lastContentElem.append(component.clone(true));
		if (componentName!=='group-block' && !lastContentElem.hasClass('row')){
			lastContentElem.append('<br class="delete-save">');
		}

		modal.close();
	});
	/*----*/


	/* Click - добавить поле для детализации */
	let detailTmp = $('.freecalc__detailing .template-detal > .detailing');
	let detailContent = $('.freecalc__detailing > .adding');
	formCalc.find('.add-detal').on('click', function () {
		detailContent.append(detailTmp.clone(true))
	});


	/*-- Click - удалить родительский блок --*/
	formCalc.on('click', '.deleted', function () {
		let parent = $(this).parent();
		let br = parent.next('.delete-save');
		if (is_elem(br)){
			br.remove();
		}
		parent.remove();
	});

	/* Запустить попап */
	formCalc.on('click', '', function () {

	});

	/* Закрыть всплывающее окно */
	formCalc.on('click', '.close', function () {
		$(this).parent().removeClass('active');
	});

	/* Открыть настройки компонента */
	formCalc.on('click', '.component .settings, .group-block .settings', function () {
		let settingWindow = $(this).parent().find('> .component-settings');
		settingWindow.addClass('active');
		// удалить
		removeSelectedDetail(settingWindow);
	});


	/* Сохранить настройки компонета (Во всплывающем окне) */
	formCalc.on('click', '.component .btn-ok', function (evt) {
		evt.preventDefault();
		// Найти инпут с картинкой
		let component = $(this).parents('.component').first();

		let img = component.find('> .component-html .img-for-input');
		let inputImg = component.find('.component-settings .input-img');
		let imgUrl = null;
		if (is_elem(inputImg) && is_elem(img)){
			if (inputImg.val()){
				img.attr('src', inputImg.val());
			}
		}
		// Найти картинку в блоке

		$(this).parents('.component-settings').removeClass('active');
	});
	/**/


	/* ------------------------ */
	// Сохранение данных калькулятора
	/* ------------------------ */
	let actionSaveCalc = 'freecalc_save_calc';
	let actionDeleteCalc = 'freecalc_delete_calc';
	let actionDuplicateCalc = 'freecalc_duplicate_calc';
	let componentsSend = {};
	let componentSettings = $('.component-settings');

	//$('button.save-calc');
	formCalc.on('submit', function (evt) {
		evt.preventDefault();
		let calcContainer = document.querySelector('.freecalc #content-column');
		// Колонки
		let columns = calcContainer.querySelectorAll('.calc-column');

		/* Колонки */
		let columnsComp = [];
		columns.forEach(function (el, idx) {
			let componentName = el.dataset.component;
			let name = $(el).find('> .column-top .column-name').text();
			if(!name)
				name = $(el).find('>.column-top  .column-name').val();

			let _column = {
				'component': componentName,
				'name': name,
				'settings': {

				},
				'nested': null,
			};

			/* Группы */
			let groups = el.querySelectorAll('.content > .group');
			let groupsComp = [];

			groups.forEach(function (el, idx) {
				let componentName = el.dataset.component;
				let nameGroup = ($(el).find('>.name-group').text()).trim();
				if (!nameGroup)
					nameGroup = ($(el).find('>.name-group').val()).trim();
				let _group = {
					'component': componentName,
					'name': nameGroup,
					'settings': {

					},
					'nested': null,
				};

				/* Компоненты в гурппах */
				let componentsForGroups = $(el).find('> .content > .component');
				// Добавить в массив
				_group.nested = getComponent(componentsForGroups, {}, 0);
				groupsComp.push(_group)
			});
			_column.nested = groupsComp;
			columnsComp.push(_column);
			/* end group */
		});

		// Общие настройки калькулятора
		let _settingsElems = formCalc.find('>.calc-settings input, >.calc-settings select');
		let calcNameEl = $('.freecalc input[name="calc-name"]');
		let _settings = null;
		if (_settingsElems){
			_settings = getSetting(_settingsElems, true);
		}
		/*let detail = $('.freecalc__detailing > .adding');
		let _detail = null;
		if (is_elem(detail))
			_detail = getSetting(_detail, true);*/

		// end настройки

		let send = {
			contents: columnsComp,
			calcname: calcNameEl.val(),
			//detailing: _detail,
			settings: _settings,
			id: calcNameEl.data('id'),
		};
		let divLoad = $('<div class="waiting-load"><p>Сохранение...</p></div>');
		formCalc.append(divLoad);

		sendResponse(send, actionSaveCalc, successSendSave);
	});


	/* ------------------------ */
	// Успешный ответ сервера
	/* ------------------------ */
	function successSendSave(response) {
		if( response.hasOwnProperty('error') && response.error==='ok' ){
			$('.waiting-load').remove();
			console.log(response);
			return ;
		}

		let id = response.messages.db;
		let successText = 'Успешно!';
		let waitingDiv = $('.waiting-load p');

		if (currentPageType === 'create' && id>0){
			let edit = $('#page-edit').val();
			// редирект на страницу созданного калькулятора
			let urlCalc = '//'+window.location.host+window.location.pathname+'?page='+edit+'&id='+id;
			if (id>0){
				waitingDiv.text(successText);
				window.location.href = urlCalc;
			}
		}
		else if(currentPageType === 'edit'){
			waitingDiv.text(successText);
			console.log('Сохранено');
			window.location.reload();
		}

	}
	/** ------- end ---------- */


	/* ------------------------ */
	// Удалить калькулятор
	/* ------------------------ */
	$('table.wp-list-table').on('click', 'a.remove-calc', function (evt) {
		evt.preventDefault();
		let removeBtn = $(this);
		let id = removeBtn.data('id');
		let tr = removeBtn.parents('tr.type-page');

		if (!id)
			return console.log('Не найден ID');

		sendResponse({id:id}, actionDeleteCalc, function (response) {
			if( response.hasOwnProperty('error') && response.error==='ok' ){
				console.log(response);
				return ;
			}

			tr.remove();
			//console.log(response);
		});
	});
	/** -------- end -------- */


	/* ------------------------ */
	// Дубликат записи
	/* ------------------------ */
	$('.duplicate .duplicate-calc').on('click', function (evt) {
		evt.preventDefault();
		let id = $(this).data('id');

		if (!id)
			return console.log('Не найден ID');

		sendResponse({id:id}, actionDuplicateCalc, function (response) {
			if( response.hasOwnProperty('error') && response.error==='ok' ){
				console.log(response);
				return ;
			}

			console.log(response);
			window.location.reload();
		});
	});

	/** -------- end -------- */


	/* ------------------------ */
	// Собрать все имена групп, и вывести их в окне настроек
	// компонента <select></select>
	/* ------------------------ */
	formCalc.on('click', '.component-settings .btn-select__name', function (evt) {
		evt.preventDefault();
		let btn = $(this);
		// select для имен всех групп
		let select = btn.parent().find('.connection-group');
		let option = select.find('option');

		// Инпуты с именем группы (берется с настроек группы)
		let namesGroup = $('.group-block .component-settings .connection-name-group');
		namesGroup.each(function () {
			let name = $(this).val();

			if ( name && !option.hasClass(name) ){
				select.append('<option class="'+name+'">'+name+'</option>');
			}
		})
	});
	/** -------- end -------- */



	/* ------------------------ */
	// Удалить уже выбранные option  общего списка
	// "Детализация"
	// компонента <select></select>
	/* ------------------------ */
	function removeSelectedDetail(settings) {
		let values = [];
		let selectedOption = $('.for-detailing option:selected');
		let thisSelect = $(settings).find('.for-detailing');

		selectedOption.each(function () {
			if ($(this).val())
				values.push($(this).val());
		});

		for (let i = 0; i<values.length; i++){
			thisSelect.find('[value='+values[i]+']').not('option:selected').remove();
		}
	}



	/* ------------------------ */
	// Сортировка
	/* ------------------------ */
	// .group-block > .content, .group > .content
	const sortable = new Sortable.default(document.querySelectorAll('.group > .content, .group-block > .content'), {
		draggable: '.component',
		handle : '.draggable',
		mouse: 300,
		drag: 300,
		touch: 300,
		distance: 20,
	});


	/* ------------------------ */
	// Выбрать компонент для изменения цены
	/* ------------------------ */
	let lastCheckComponent = null;
	formCalc.on('click', '.is-check-component .component', function (evt) {
		evt.stopPropagation();
		evt.preventDefault();
		if (!is_elem(lastCheckComponent))
			return;
		if (!is_elem('.is-check-component'))
			return;
		if (!$(this).hasClass('component'))
			return;

		let c = $(this);
		let cClass = c.data('component');
		let cID = '';
		let cName = '';
		let cText = '';
		if (c.hasClass('group-block')){
			cName = c.data('name');
			cText = c.data('name');
		}
		else{
			let inputComponent= c.find('> .component-html .reg-calc');
			cID = inputComponent.attr('id');
			cText = c.find('> .component-html .text').first().text();
			cName = inputComponent.attr('name')
		}
		console.log(c);

		lastCheckComponent.attr('data-cid', cID);
		lastCheckComponent.attr('data-cname', cName);
		lastCheckComponent.attr('data-cclass', cClass);
		lastCheckComponent.text(cText || cName);

		//lastCheckComponent=null;
		$('.is-check-component').removeClass('is-check-component');
	});


	// Добавить класс для возможности выбора компонента
	formCalc.on('click', '.component-settings .other-price-component', function (evt) {
		evt.stopPropagation();
		evt.preventDefault();
		formCalc.find('.freecalc-body').addClass('is-check-component');
		lastCheckComponent = $(this);
		// Запустить обработчик для выбора
	});

	// Очистить поле с указанием компонента для цены
	formCalc.on('click', '.component-settings .empty-up', function (evt) {
		// other-price-component
		evt.stopPropagation();
		let opc = $(this).parent().find('.set');
		if(!is_elem(opc))
			return;

		//console.log(opc);
		opc = emptyDataAttr(opc);
		opc.empty();

	});

	function emptyDataAttr(el) {
		if (!is_elem(el))
			return;
		let data = el.data();
		if (Object.keys(data).length > 0) {
			for (let key in data) {
				if (key==='name')
					continue;
				el.data(key, '');
			}
		}
		return el;
	}
	/*-- end --*/



	function printJSON(obj) {
		console.log(JSON.stringify(obj, null, 2));
	}
	/**
	 * Добавить в общий обьект компонентов найденый компонент
	 * @components {obj} -
	 * @add {obj} -
	 * */
	function getComponent(component) {
		if (!is_elem(component))
			return;
		let comps = [];

		/*******/
		function getC(component, obj, count){
			let _compArray = [];
			component.each(function () {
				let $el = $(this);
				let nextComponent = $el.find('> .content > .component');
				let componentName = $el.data('component');
				let _setting = getSetting($el);
				let _html = getHTMLComponent($el);

				let _comp = {
					'component': componentName,
					'name': '',
					'settings': _setting,
					'data': _html,
					'nested': [],
				};

				if (count>0){
					obj.nested.push(_comp);
				} else{
					_compArray.push(_comp);
				}

				if (is_elem(nextComponent)){
					return getC(nextComponent, _comp, count+1)
				}

			});
			//console.log(obj);
			return _compArray;
		}
		/********/

		return getC(component, {}, 0);
	}


	/**
	 * Получить настройки компонента, или общие настроки калькулятора
	 * @component {jQuery} - отдельный елемент, где искать настройки
	 * "isCustomElem {bool} - собрать массив с переданного елемента
	 * */
	function getSetting(component, isCustomElem) {
		if (!is_elem(component))
			return;

		let _sett = {};
		let settings = component.find('>.component-settings input, >.component-settings select, >.component-settings textarea, >.component-settings .set');
		if (isCustomElem)
			settings = component;

		settings.each(function () {
			let $el = $(this);
			//type: getInputType($el),
			//value: getSettingValue($el),
			// [name="":value]
			if ($el.hasClass('set')){
				_sett[$el.data('name')] = getDataKeys($el);
			}
			else
				_sett[$el.attr('name')] = getSettingValue($el);
		});

		return _sett;
	}

	/* Определить тип input, select */
	function getInputType(element) {
		let type = $(element).attr('type');

		if (element instanceof jQuery){
			element = element.get(0);
		}
		if (!type)
			type = element.tagName.toLowerCase();
		return type;
	}

	/* Получить значение настройки выбраного или активного input, select */
	function getSettingValue(element, attr) {
		if(!is_elem(element))
			return;

		let value = null;
		if(getInputType(element) === 'select'){
			if (attr)
				return element.find('option:selected').attr(attr);
			return element.find('option:selected').val();
		}
		else if(getInputType(element) === 'checkbox'){
			return element.prop('checked') ? 'on':'off';
		}

		if (attr)
			return element.attr(attr);

		return element.val();
	}

	/* Данные самого компонента для вывода (backend/frontend)
	*	 data-attributes
	*  */
	function getHTMLComponent(element, isCustom) {
		if(!is_elem(element))
			return console.log('getHTMLComponent: not found');

		let _elem = null;
		if (isCustom)
			_elem = element;
		else
			_elem = element.find('> .component-html *');

		let _html = {};
		let countText = 1;
		let count = 1;

		_elem.each(function (idx) {
			let $el = $(this);
			let data = $el.data();
			if (Object.keys(data).length > 0){
				for(let key in data){
					//
					if (key==='text'){
						if (_html.hasOwnProperty(key)) {
							key = key + countText;
							countText++;
						}
						let text = $el.text();
						if ($el.get(0).tagName.toLowerCase() === 'input'){
							text = $el.val();
						}

						_html[key] = text.trim();
					}
					else{
						let _k = key;
						if (_html.hasOwnProperty(key)) {
							_k = key + count;
							count++;
						}
						_html[_k] = data[key];
					}
					// endif;
				}
				// endfor;
			}
			else{

			}
			// endif;

		});

		return _html;
	}

	// получить значения data-attribute
	function getDataKeys($el){

		let _html = {};
		let countText = 1;
		let count = 1;

		let data = $el.data();
		if (Object.keys(data).length > 0){
			for(let key in data){
				//
				if (key==='text'){
					if (_html.hasOwnProperty(key)) {
						key = key + countText;
						countText++;
					}
					let text = $el.text();
					if ($el.get(0).tagName.toLowerCase() === 'input'){
						text = $el.val();
					}

					_html[key] = text.trim();
				}
				else{
					let _k = key;
					if (_html.hasOwnProperty(key)) {
						_k = key + count;
						count++;
					}
					_html[_k] = data[key];
				}
				// endif;
			}
			// endfor;
		}
		else{

		}
		// endif;
		return _html;
	}

	/* Свернуть колонку */
	formCalc.on('click', '.column-top .slide',function () {
		let el = $(this);
		let elSlide = el.parents('.calc-column').find('>.content');
		if (el.hasClass('is-hide')) {
			el.removeClass('is-hide');
			elSlide.slideDown('300');
			el.find('.fa-plus').removeClass('fa-plus').addClass('fa-minus')
		} else {
			el.addClass('is-hide');
			elSlide.slideUp('300');
			el.find('.fa-minus').removeClass('fa-minus').addClass('fa-plus')
		}
	});

	/* Отправить запрос */
	function sendResponse(data, action, success) {
		let url = ajaxurl;
		data.nonce = wooAjaxScript.nonce;
		data.action = action;

		$.ajax({
			type: "POST",
			url: url,
			success: function (response) {
				success(response);
			},
			async: true,
			data: data,
			dataType: 'JSON',
		});
	}





function startModal() {
	let contentModal = document.querySelector('.template .popup-template');

	if (!is_elem(contentModal))
		return false;

	var modal = new tingle.modal({
		footer: false,
		closeMethods: ['overlay', 'button', 'escape'],
		closeLabel: "Close",
		cssClass: ['custom-class-1', 'custom-class-2'],
		onOpen: function() {
			//console.log('modal open');
		},
		onClose: function() {
			//console.log('modal closed');
		},
		beforeClose: function() {
			// here's goes some logic
			// e.g. save content before closing the modal
			return true; // close the modal
		}
	});
	// set content
	modal.setContent(contentModal);

	return modal;
}


/*------ libs -----*/

/* Формат числа на группы */
function number_format(_number, _decimal, _separator) {
	_decimal = _decimal || 0;
	_separator = _separator || ' ';
	_number = _number || 0;
	var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
	var separator = (typeof (_separator) != 'undefined') ? _separator : '';
	var r = parseFloat(_number);
	var exp10 = Math.pow(10, decimal);
	r = Math.round(r * exp10) / exp10;
	rr = Number(r).toFixed(decimal).toString().split('.');
	b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
	r = (rr[1] ? b + '.' + rr[1] : b);
	return r;
}

function is_elem(elem) {

	if (!elem){
		return false;
	}
	if (elem instanceof jQuery || elem instanceof NodeList){
		return elem.length > 0;
	}
	else if(typeof elem == 'string'){
		return $(elem).length > 0;
	}

	return !!elem;
}


})( jQuery );