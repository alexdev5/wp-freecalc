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


  /* Click - добавить колонку */
  $('.add-column').on('click', function () {
    contentColumn.append(templates.find('.column').clone(true))
  });

  /* Click - добавить группу */
  formCalc.on('click', '.add-group', function () {
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


  /*-- Click - удалить родительский блок --*/
  formCalc.on('click', '.deleted', function () {
    let parent = $(this).parent();
    console.log(parent);
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
    $(this).parent().find('> .component-settings').addClass('active');
  });


  /* Сохранить настройки компонета (Во всплывающем окне) */
  formCalc.on('click', '.component .btn-ok', function (evt) {
    evt.preventDefault();
    // Найти инпут с картинкой
    let component = $(this).parents('.component');
    let img = component.find('.img-for-input');
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
  let actionUpdateCalc = 'updateCalc';
  let actionDeleteCalc = 'deleteCalc';
  let componentsSend = {};

  $('button.save-calc').on('click', function (evt) {
    evt.preventDefault();
    let calcContainer = document.querySelector('.freecalc #content-column');
    // Колонки
    let columns = calcContainer.querySelectorAll('.calc-column');

    /* Колонки */
    let columnsComp = [];
    columns.forEach(function (el, idx) {
      let componentName = el.dataset.component;
      let name = $(el).find('>.column-name').text();
      let _column = {
        'component': componentName,
        'componentName': name,
        'settings': {

        },
        'nested': null,
      };

      /* Группы */
      let groups = el.querySelectorAll('.content > .group');
      let groupsComp = [];
      groups.forEach(function (el, idx) {
        let componentName = el.dataset.component;
        let nameGroup = $(el).find('>.name-group').text();
        let _group = {
          'component': componentName,
          'componentName': nameGroup,
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

    //sendResponse({}, actionSaveCalc);
    printJSON(columnsComp);
  });

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
    let arrObj = [];

    /*******/
    function getC(component, obj, count){
      count = count || 0;
      let _comps = [];

      component.each(function (idx) {
        let $el = $(this);

        let componentName = $el.data('component');
        let componentHTML = $el.find('>.component-html').clone(true);
        let settingsElements = $el.find('>.component-settings input, >.component-settings select');

        //console.log(componentName);
        /* Settings component */
        let settingObj = getComponentSetting(settingsElements);
        /* end settings component */

        /*let obj = {};
        obj.component = componentName;
        obj.componentName = componentName;
        obj.componentHTML = componentHTML.serialize();
        obj.settings = {};
        obj.nested = {};*/

        let comps = {
          'component':componentName,
          'componentName':'',
          'componentHTML':componentHTML.serialize(),
          'settings':{},
          'nested':[],
        };

        if (count>0){
          obj.nested.push(comps);
        }
        else{
          obj = comps;
        }

        let nextComponent = $el.find('> .content > .component');
        if (is_elem(nextComponent)){
          return getC(nextComponent, comps, count+1);
        }

      });// end each
      //printJSON(obj);
      arrObj.push(obj);

      return obj;
    }
    /********/


    let _obj = getC(component);
    //console.log(arrObj);
    return arrObj;
  }

  /* Получить настройки компонента */
  function getComponentSetting(component) {
    if (!is_elem(component))
      return;

    let obj = {};
    //
    return obj;
  }


  /* Отправить запрос */
  function sendResponse(data, action) {
    let url = ajaxurl;
    data.nonce = wooAjaxScript.nonce;
    data.action = action;

    $.ajax({
      type: "POST",
      url: url,
      success: function (response) {
        console.log(response);
      },
      async: true,
      data: data,
      /*dataType: 'JSON',*/
    });
  }

})( jQuery );




function startModal() {
  let contentModal = document.querySelector('.template .popup-template');


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
    console.log('Не передан елемент');
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

