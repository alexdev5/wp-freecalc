(function ($) {
  'use strict';

  /*
  * Сделать расчет % от суммы
  * */

  let freecalc = $('.freecalc');
  if (!is_elem(freecalc))
    return console.log('freecalc undefined');
  let settings = getSettings();

  //connect-element
  freecalc.on('click', '.connect-element input', function (evt) {
    let el = $(this).parent();
    let elActive = el.parent().find('.connect-element.active');
    let selectorGroup = el.data('connect-group');

    // Удалить активный класс
    if (is_elem(elActive))
      elActive.removeClass('active');

    let group = $('.visible__'+selectorGroup);
    let groupsElems = group.parent().find('.visible-for-components');
    groupsElems.css('display', 'none');
    group.css('display', 'flex');
    groupsElems.find('.worktop-comp').removeClass('active');
    group.find('.worktop-comp').addClass('active');
  });


  let totalsElements = {};
  let radialData = {};
  let totalsElementsAll = {};


  /* ------------------------ */
  // Переключение вкладок
  /* ------------------------ */
  freecalc.on('click', '.freecalc-tabs .freecalc-tab', function (evt) {
    $(this).parent().find('>.active').removeClass('active');
    $(this).addClass('active');
    let tab = $('.freecalc-column-'+$(this).data('id'));
    let tabActive = $('.freecalc-column.active');
    tabActive.removeClass('active');
    tab.addClass('active');


    // Посчитать сумму и записать в ДОМ елемент
    setSumDOM(calcTotalSum());
  });



  /* ------------------------ */
  // Расчет стоимости
  // next-check-price - цену брать со слудеющей группы
  // prev-calc-area - цену выбраного checkbox с группы * на площадь предыдущего
  /* ------------------------ */
  freecalc.on('change', '.group .reg-calc[type=checkbox], .group .reg-calc[type=radio]', function (evt){

    let $el = $(this);
    let firstGroup = $el.parents('.group').first();
    let price = balrate($el.data('price')) || 0;

    // Обновить елементы POC (которые связаны с данным компонентом по цене)
    let pocObj = getPOCCheck();
    let count = 0;
    if (Object.keys(pocObj).length > 0){
      for(let key in pocObj){
        let elemGroup = firstGroup.find('[data-name="'+key+'"]');
        //
        if (is_elem(elemGroup)){
          let _array = pocObj[key].array;
          let _object = pocObj[key].object;
          // по массиву(checkbox)
          for (let i = 0; i<_array.length; i++){
            if (count>30){
              console.log(_array);
              return;
            }
            updatePrice(_array[i]);
            count++;
          }

          // по объекту(area)
          for(let key in _object){
            if(key && key.indexOf('worktop')!==-1){
              // Это для площади, если ключ площади,
              // то перезаписать в основной обоъект сумму
              setKeyCurrentObject(key, price*_object[key]);
              let _input = $('[data-name="'+key+'"] input[type="number"]').first();
              _input.keyup();
              //console.log(getCurrentKye());
              break;
            }
          }
        }
        // end if
      }
      //end for1
    }
    // end update POC

    updatePrice(this);
  });



  /* ------------------------ */
  // Функция изменения цены для компонентов
  // Вызывпется при изменения checkbox
  // isntWrite - не записывать в объект текущий инпут
  /* ------------------------ */
  function updatePrice(el, isntWrite){
    let $el = $(el);
    let parent = $el.parents('.component').first();

    let parentGroupBlock = $el.parents('.group-block').first();
    let price = balrate($el.data('price')) || 0;
    let name = $el.attr('name');
    // detail object
    // Площадь
    let area = 0;
    let dvar = {};

    dvar.el = $el;
    dvar.prop = 1;


    // группа, которая отображается при клике на определенный компонент
    // Очистить ее
    let connectElement = $el.parents('.connect-element').first();
    if (is_elem(connectElement)){
      emptyChecked(connectElement);
    }

    // price-other-component
    let pricePOC = balrate(priceOtherComponent(el, isntWrite));
    if (pricePOC!==false){
      price *= pricePOC;
    }

    let valueAction = getActionValue($el);
    if (valueAction !== false && valueAction>=0){
      price *= valueAction;
      // Записывать площадь в детализацию, если указано
      if ($el.data('showaction')==='on')
        dvar.prop = valueAction;
    }

    if($el.hasClass('check-panel')){
      // Вырез под варочную панель
      //dvar.prop = 1;
      dvar.type = 'hob-cutout-js';
    }
    else if($el.hasClass('check-washing')){
      // Вырез под мойку
      //dvar.prop = 1;
      dvar.type = 'sink-cutout-js';
    }
    else if($el.hasClass('check-stone')){
      // Мойка из камня
      //dvar.prop = 1;
      dvar.type = 'stone-sink-js';
    }
    else if($el.hasClass('check-radial')){
      // Количество скруглений
      let parentWorktop = $el.parents('.worktop-comp').first();
      let numRadial = parentWorktop.find('.check-radial:checked').length;
      let thisPrice = price * numRadial;
      dvar.prop = numRadial;
      dvar.type = 'count-fillets-js';
      dvar.price= thisPrice;
    }
    else if (parentGroupBlock.hasClass('prev-calc-area')){
      // Посчитать площадь с предыдущего блока: S * thisPrice
      area = eachNumbers(parentGroupBlock.prev());
      price = toMeter(area) * price;
      // Детализация prev-calc-area.
      dvar.area = area;
    }
    else if(parentGroupBlock.hasClass('calc-area')){
      // checkbox в группе для расчета площади (стеновая панель)
      area = transMeters(eachNumbers(parentGroupBlock));
      price = area * price;
    }
    else if ( is_elem(parent.find('input[type=number]')) ){
      // подьем на этаж
      area = eachNumbers(parent);
      price *= area;
    }
    // endif

    dvar.price = price;
    dvar.area = area;

    // В группе не считается стоимость
    if (!parentGroupBlock.hasClass('isnt-add-price')){

    }

    // Запись суммы в объект
    if ($el.prop('checked')){
      setPropertyDetail(dvar);
      if (!parentGroupBlock.hasClass('isnt-add-price')){
        setKeyCurrentObject(name, price);
      }
    }
    else{
      setPropertyDetail({
        el: $el,
        prop:0,
        price:0,
        def: 0,
        type: dvar.type
      });
      if (!parentGroupBlock.hasClass('isnt-add-price')){
        setKeyCurrentObject(name, price, true);
      }
    }


    if (!parentGroupBlock.hasClass('isnt-add-price')){
      // Посчитать сумму и записать в ДОМ елемент
      setSumDOM(calcTotalSum());
    }
  }




  /* ------------------------ */
  // Получить число, если указан экшн в настройках компонента
  /* ------------------------ */
  function getActionValue($el) {
    // mult-area - умножить на площадь столешницы
    // mult-length - умножить на длинну столешницы
    let action = $el.data('action');
    if (!action)
      return false;

    if (action === 'mult-area')
      return getAreaWorktop();
    else if(action === 'mult-length')
      return lineForEdge();

    return false;
  }



  /* ------------------------ */
  // Подъем на этаж/ расчет площади
  // next-check-price - цену брать со слудеющей группы (this)
  // prev-calc-area - цену выбраного checkbox с группы * на площадь предыдущего
  /* ------------------------ */
  let manualInputs = $('.calc-area [type=number], .calc-dot-number [type=number], .text-input-text [type=number]');
  manualInputs.on('keyup', function (evt) {
    let $el = $(this);
    let component = $el.parents('.components').first();
    let groupBlock = $el.parents('.group-block').first();
    let checkComponent = component.find('[type=checkbox]');
    let checkGroup = groupBlock.find('[type=checkbox]');
    let area = eachNumbers(groupBlock);
    let price = $el.data('price');
    let name = $el.attr('name');
    let isCheck = false;
    let dvar = {};

    // расчет площади
    if (groupBlock.hasClass('calc-area')){
      if (groupBlock.find('[type=number]').length <= 1){
        dvar.prop = area;
        area = toMeter(area);
      }
      else
        area = transMeters(area);
    }

    if(groupBlock.hasClass('next-check-price')){
      // Если цена со следующего блока
      // Все данные берем с него
      let nextPriceInput = groupBlock.next().find('input:checked');
      isCheck = is_elem(nextPriceInput);
      name = nextPriceInput.attr('name');
      price = nextPriceInput.data('price') || 0;
    }
    else if (is_elem(checkComponent)){
      // Есть чек в компоненте
      isCheck = checkComponent.prop('checked');
      name = checkComponent.attr('name');
      price = checkComponent.data('price');
    }
    else if(is_elem(checkGroup)){
      // Есть чек в группе
      isCheck = checkGroup.prop('checked');
      name = checkGroup.attr('name');
      price = checkGroup.data('price');
    }
    let amount = area * balrate(price);

    // Для детализации
    if (groupBlock.hasClass('detailing-js')){
      dvar.type = groupBlock.data('for-detailing');
    }

    dvar.area = area;
    dvar.price = amount;

    if (!isCheck){
      return console.log('Not find name-check | onNumber');
    }

    setPropertyDetail(dvar);
    setKeyCurrentObject(name, amount);
    let total = calcTotalSum();
    setSumDOM(total);
  });



  // Если есть у родителя класс "next-check-price"
  // взять стоимость у следующего блока
  // ()
  function calcNextPrice(nextElem){

  }


  /* ------------------------ */
  //Указать цену не с текущего компонента, а с выбраного
  //он выбирается после клика, и сохраняется в настройках
  // Принимает сам компонент (.component, .group-block)
  /* ------------------------ */
  let pocInputs = {};
  function priceOtherComponent(el, isntWrite){
    // other-price-component (poc)
    // data-cname - у компонента, с которого брать цену это "data-name"
    // data-cclass - у компонента, с которого брать цену это "data-name"

    let $el = $(el);
    let $comp = getcNameComponent($el);

    let cname = $comp.cname;
    let cclass = $comp.cclass;

    if(!cname && !cclass)
      return false;
    let key = $el.attr('id') || $el.attr('name');
    let inpType = getInputType($el);

    // if
    if (!$el.prop('checked') && inpType !== 'number'){
      setPOCCheck(cname, {val:el, type: 'array', del: true});
      return false;
    }
    // endif;


    let selector = '.'+cclass+'[data-name="'+cname+'"]';
    let toComp = $(selector);
    if (!is_elem(toComp)){
      console.log('priceOtherComponent | component no find');
      return false;
    }


    let check = toComp.find('input[type=checkbox]:checked, input[type=radio]:checked');
    if (cclass !== 'group-block'){
      check = $el;
    }
    let price = check.data('price');

    // записать в объект инпут, что бы потом обновить его,
    // если цена не была найдена
    if (!isntWrite && inpType !== 'number')
      setPOCCheck(cname, {val:el, type: 'array'});

    return price || 0;
  }


  /* Получить имя компонента, у которого указана цена
  * other-price-component (poc)
  * */
  function getcNameComponent($el) {
    let $comp = $el.parents('.component').first();

    let cname = $comp.data('cname');
    let cclass = $comp.data('cclass');

    return {
      cname: cname,
      cclass: cclass,
    };
  }


  // добавить елемент в объект POC
  function setPOCCheck(key, $param) {
    /**
      $param = {
        val: значение, которое записать
        type: Тип сохраняемого значения (array, single, object)
      }
    * */

    $param.type = $param.type || 'array';

    let _data = getPOCCheck();
    let isKey = _data.hasOwnProperty(key);
    let _object = {};
    let _array = [];
    let _idx = -1;

    if (!isKey){
      _data[key] = {};
      _data[key]['object'] = {};
      _data[key]['array'] = [];
    }
    _object = _data[key]['object'];
    _array = _data[key]['array'];

    if ($param.type === 'array')
      _idx = _array.indexOf($param.val);

    // удалить с массива объектов ключ
    if ($param.del){
      if ($param.type === 'object'){
        delete _object[$param.val.name];
      }
      else if($param.type === 'array'){
        if (_idx !== -1){
          _array.splice(_idx, 1);
        }
      }
      return _data;
    }
    // end delete


    if ($param.type === 'object'){
      _object[$param.val.name] = $param.val.val;
    }
    else if($param.type === 'array'){
      if (_idx === -1){
        _array.push($param.val);
      }
    }

    //console.log(_data);
    return _data;
  }


  // получить елемент с объекта POC
  function getPOCCheck() {
    return pocInputs;
  }


  /** ------------------------ */
  // Очистить выбраные checkbox
  /** ------------------------ */
  function emptyChecked(connectElement){
    // при переключении между блоками, убрать чеки
    let thisGroup = connectElement.parents('.group').first();
    //let thisGroupID = thisGroup.data('id');

    let groupNext = thisGroup.next();
    let checkedGroupNext = groupNext.find('input:checked');
    let numbers = groupNext.find('input[type=number]');
    if (is_elem(checkedGroupNext)){
      checkedGroupNext.prop('checked', false);
      checkedGroupNext.change();
    }
    if (is_elem(numbers)){
      numbers.val('');
      numbers.first().keyup();
    }
  }



  /** ------------------------ */
  // Для расчета площади столешниц
  // Если не передавать тип, то определяет активную и считает
  /** ------------------------ */
  function getAreaWorktop(type){
    // type = worktop-line, worktop-g, worktop-p
    let worktop = $('.worktop-comp.active');
    let cname = worktop.data('component');
    let s = 0;
    if(type){
      worktop = $('.worktop-comp.'+type);
      cname = type;
    }

    if (!is_elem(worktop))
      return false;

    let w1 = parseInt(worktop.find('.w1').val()) || 0;
    let w2 = parseInt(worktop.find('.w2').val()) || 0;
    let w3 = parseInt(worktop.find('.w2').val()) || 0;
    let l1 = parseInt(worktop.find('.l1').val()) || 0;
    let l2 = parseInt(worktop.find('.l1').val()) || 0;
    let l3 = parseInt(worktop.find('.l1').val()) || 0;

    if (cname === 'worktop-g'){
      s = transMeters( (l1*w2)+(l2*w1)-(w1*w2));
    }
    else if(cname === 'worktop-line'){
      s = transMeters(w1*l1);
    }
    else if(cname === 'worktop-p'){

      let y = transMeters(l1*w1);
      let x = transMeters((l2-w1)*w2);
      let z = transMeters((l3-w1)*w3);

      s = (y+x+z);
    }

    // Пересчитать "подгиб кромки"
    let check = $('.component.edge-worktop input.dot');
    if (check.prop('checked'))
      check.change();


    return s>0 ? s : 0;
  }



  /** ------------------------ */
  // Для подгиба кромки, посчитать длинну
  /** ------------------------ */
  function lineForEdge(){
    // type = worktop-line, worktop-g, worktop-p
    let worktop = $('.worktop-comp.active');
    let cname = worktop.data('component');
    let l = 0;

    if (!is_elem(worktop))
      return false;

    if (cname === 'worktop-g'){
      let w1 = parseInt(worktop.find('.w1').val()) || 0;
      let w2 = parseInt(worktop.find('.w2').val()) || 0;
      let l1 = parseInt(worktop.find('.l1').val()) || 0;
      let l2 = parseInt(worktop.find('.l1').val()) || 0;
      l = ((l1-w2) + (l2-w1))/1000;
    }
    else if(cname === 'worktop-line'){
      let w1 = parseInt(worktop.find('.w1').val()) || 0;
      l = w1/1000;
    }
    else if(cname === 'worktop-p'){
      let w1 = parseInt(worktop.find('.w1').val()) || 0;
      let w2 = parseInt(worktop.find('.w2').val()) || 0;
      let w3 = parseInt(worktop.find('.w2').val()) || 0;
      let l1 = parseInt(worktop.find('.l1').val()) || 0;
      let l2 = parseInt(worktop.find('.l1').val()) || 0;
      let l3 = parseInt(worktop.find('.l1').val()) || 0;
      l = ((l1-w2-w3) + (l2-w1) + (l3-w1))/1000;
    }

    //
    return l || 0;
  }


  /* ------------------------ */
  // Прямая столешница
  /* ------------------------ */
  freecalc.on('keyup', '.worktop-line [type=number]', function (evt) {
    // worktop-line
    let input = $(this);
    let parent = input.parent();
    //let price = parent.data('price');
    let price = priceOtherComponent(this);


    let name = parent.data('name');
    let s = getAreaWorktop('worktop-line');
    let amount = s * balrate(price);

    // Детализация
    setPropertyDetail({
      el: null,
      type:'worktop-js',
      prop:s,
      price:amount,
    });

    // пересчитать в детализацию: подложка из фанеры
    // data-for-detailing
    // solid-plywood-backing-js
    /*let checkSolid = $('.detailing-js[data-for-detailing="solid-plywood-backing-js"] input.dot');
    if (checkSolid.prop('checked')){
      checkSolid.change();
    }*/

    //priceOtherComponent();
    // setPOCCheck()
    let cname = getcNameComponent(input).cname;

    // Для дальнейшего обновления, если компонент от которого
    // зависит цена, будет изменятся
    setPOCCheck(cname, {val:{name: name, val: s}, type: 'object'});

    setKeyCurrentObject(name, amount);

    let total = calcTotalSum();
    setSumDOM(total);
  });


  /* ------------------------ */
  // Г-образаня столешница
  /* ------------------------ */
  freecalc.on('keyup', '.worktop-g [type=number]', function (evt) {
    let input = $(this);
    let parent = input.parent();
    let price = parent.data('price');
    let name = parent.data('name');

    let s = getAreaWorktop('worktop-g');
    let amount = s * balrate(price);

    // Детализация
    setPropertyDetail({
      el: null,
      type:'worktop-js',
      prop:s,
      price:amount,
    });

    // пересчитать в детализацию: подложка из фанеры
    // data-for-detailing
    // solid-plywood-backing-js
    /*let checkSolid = $('.detailing-js[data-for-detailing="solid-plywood-backing-js"] input.dot');
    if (checkSolid.prop('checked')){
      checkSolid.change();
    }*/

    setKeyCurrentObject(name, amount);
    let total = calcTotalSum();
    setSumDOM(total);
  });



  /* ------------------------ */
  // П-образаня столешница
  /* ------------------------ */
  freecalc.on('keyup', '.worktop-p [type=number]', function (evt) {
    let input = $(this);
    let parent = input.parent();
    let price = parent.data('price');
    let name = parent.data('name');

    let s = getAreaWorktop('worktop-p');
    let amount = s *balrate(price);

    // Детализация
    setPropertyDetail({
      el: null,
      type:'worktop-js',
      prop:s,
      price:amount,
    });

    // пересчитать в детализацию: подложка из фанеры
    // data-for-detailing
    // solid-plywood-backing-js
    /*let checkSolid = $('.detailing-js[data-for-detailing="solid-plywood-backing-js"] input.dot');
    if (checkSolid.prop('checked')){
      checkSolid.change();
    }*/

    setKeyCurrentObject(name, amount);
    let total = calcTotalSum();
    setSumDOM(total);
  });


  /* Получить текущий объект для сохранения чисел
  * (исходя из открытых вкладок)
  *  */
  function getCurrentKye(key){
    let columnName = $('.freecalc-tab.active').data('name');
    let worktopName = $('.worktop-comp.active').data('component');

    if (!totalsElements.hasOwnProperty(columnName)){
      totalsElements[columnName] = {};
    }
    /*if (!totalsElements[columnName].hasOwnProperty(worktopName)){
      totalsElements[columnName][worktopName] = {};
    }*/

    return totalsElements[columnName];//[worktopName];
    //return totalsElementsAll;
  }

  function setKeyCurrentObject(key, value, isDelete){
    let _obj = getCurrentKye();

    if (isDelete){
      delete _obj[key];
      //console.log('del');
      return key;
    }
    //
    //if (!_obj.hasOwnProperty(key)){
      _obj[key] = value;
    //}

    return value;
  }



  /* ------------------------ */
  // Добавить в объект детализации
  /* ------------------------ */
  let detailingObject = {};


  /* ------------------------ */
  // Записать данные в таблицу датализации
  /* ------------------------ */
  function setPropertyDetail(data) {
    /*el: елемент, на котором произошло событие,
      prop: то, что пишеться во вторую колонку, detailing__prop
      price: запись в 3-ю колонку,
      text: наименование, что нужно записать,
      type:'worktop-js' - класс, куда записывать данные,
    * */

    let toElement = null;
    let toPrice = null;
    let toProp = null;

    if (is_elem(data.el && !data.type)){
      let input = data.el;
      let inputParent = input.parents('.component').first();
      let parentGroup = inputParent.parent();

      if(inputParent.hasClass('detailing-js')){
        // Если с компонента идет запись в детализацию
        data.type = inputParent.data('for-detailing');
      }
      else if(parentGroup.hasClass('detailing-js')){
        // Если с группы идет запись в детализацию
        data.type = parentGroup.data('for-detailing');
      }
      else if(parentGroup.parent().hasClass('detailing-js')){
        // Если с группы идет запись в детализацию
        data.type = parentGroup.parent().data('for-detailing');
      }
      else{
        return;
      }

      // Записать значение в "prop" если оно есть
      let textElem = inputParent.find('.text-name');
      if (is_elem(textElem) && !data.hasOwnProperty('def')){
        data.prop = textElem.text();
      }

      if(!data.prop){
        data.prop2 = inputParent.find('.text').first().text();
      }

      toElement = $('.'+data.type);

      if (!is_elem(toElement))
        return;
    }
    else{
      toElement = $('.'+data.type);
    }

    // Элементы, куда записывать значения
    toPrice = toElement.find('.detailing__price');
    toProp = toElement.find('.detailing__prop');
    //
    let toPriceNum = toPrice.find('.num');
    let toPropNum = toProp.find('.num');
    let prop = data.prop!==0 && !data.prop ? 1 : data.prop;
    let price = data.price || 0;
    let isChange = false;
    let newPrice = false;

    // Непосредственно запись в таблицу
    if (data.type === 'material-js'){
      // материал
      prop = prop || 0;
      toProp.find('.mat').text(prop);
      toProp.find('.cat').empty();
      isChange = 1;
    }
    else if(data.type === 'class-stone-js'){
      // тип камня
      toProp = $('.material-js .detailing__prop');
      toProp.find('.cat').text(prop);
      isChange = 1;
    }
    else if(data.type === 'wall-side-js'){
      // Для поля пристеночного бортика
      toProp.find('.len').text(number_format(data.area));
      toPropNum.text(prop);
      isChange = 1;
    }
    else if(data.type === 'plinth-length-js'){
      // Пристеночный бортик, длинна плинтуса
      let _detail = $('.wall-side-js');
      toProp = _detail.find('.detailing__prop');
      toPriceNum = _detail.find('.detailing__price .num');
      toProp.find('.len').text(number_format(data.prop));
      //toPropNum.text(prop);
      isChange = 1;
    }
    else if(data.type === 'depth-worktop-js'){
      // толщина столешницы
      toPropNum.text(data.prop2);
      isChange = 1;
    }
    else{
      toPropNum.text(prop);
      isChange = 1;
    }

    // не записывать цену, если она изменилась где то выше в блоке
    if (!newPrice)
      toPriceNum.text(number_format(price));

    //

    if (isChange){
      toElement.css('background', '#F29B68');
    }

    //console.log(data);
  }

  function setInDetailing(params) {
    /**
    * params.class
    * params.name
    * params.price
    * */

  }

  /**
   * Принимает группу интпутов, и умножает их
   * */
  function eachNumbers(parents) {
    if(!parents)
      return;
    let s = 1;
    parents.find('[type=number]').each(function () {
      let _num = parseInt($(this).val()) || 0;
      s*=_num;
    });

    if (!s)
      return  0;
    return Math.floor(s * 100) / 100;
  }



  /* Записать сумму в объект
  * @element {DOM:input, textarea} - element с которого брать данные
  * @element {object} - объект для расчета
  *
  * return - {@number} - записанное число
  * */
  function setSumObject(el, object, isDelete) {
    /*el = $(el);
    if (!is_elem(el))
      return ;
    let price = el.data('price') || 0;
    let key = el.prop('name');

    if (!isDelete)
      totalsElements[key] = price;
    else
      delete totalsElements[key];

    return price;*/
  }


  /* Посчитать итоговую сумму, которая лежит в объекте
  * @element {object} - объект для расчета
  *
  * return - @number
  * */
  function calcTotalSum() {
    let _obj = getCurrentKye();
    let total = 0;
    for(let key in _obj){
      if (!_obj.hasOwnProperty(key))
        continue;
      total += _obj[key];
    }

    return total>0 ? total : 0;
  }


  function setSumDOM(sum) {
    let div = $('.freecalc .total-sum');
    if (!is_elem(div))
      div = $('.freecalc__footer').append('<div class="total-sum"></div>');
    let prise = number_format(sum, 0, ' ');
    div.find('.sum').text(prise);
    div.find('.curr').text((settings.calc_curr_out).toUpperCase());
  }


  /* Получить настройки калькулятора */
  function getSettings() {
    let _sett = freecalc.find('.settings-calc');
    if (!is_elem(_sett))
      return;
    let text = _sett.text();
    if (!text)
      return;
    return JSON.parse(text);
  }


  /**
   * Перевести по курсу
   * */
  function balrate(num, isTrans) {
    if (isTrans)
      num = transMeters(num);


    let _sett = getSettings();
    let balRate = _sett.balrate_usd;
    if (_sett.balrate_usd_manual)
      balRate = _sett.balrate_usd_manual;

    if(_sett.calc_curr_in==='usd' && _sett.calc_curr_out==='rub'){
      num = num*balRate;
    }
    else if(_sett.calc_curr_in==='rub' && _sett.calc_curr_out==='usd'){
      num = num/balRate;
    }

    return num;
  }

  /**
   * Перевести площадь в метры
   * */
  function transMeters(number){
    const TRANSM = 1000000;
    return number/TRANSM;
  }

  function toMeter(number){
    const TRANSM = 1000;
    return number/TRANSM;
  }


  /**
   * Получить тип инпута
   * */
  function getInputType(input) {
    let type = $(input).attr('type');
    if (!type)
      type = input.tagName.toLowerCase();
    return type;
  }


  /* Отправить запрос */
  function sendResponse(data, action, success) {
    let url = freeCalcName.url;
    data.nonce = freeCalcName.nonce;
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


  //
  function isNativeObject(object) {
    return Object.prototype.toString.call(object) === '[object Object]';
  }

})(jQuery);

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