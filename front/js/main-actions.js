(function ($) {

  /* ------------------------ */
  // Variables
  /* ------------------------ */
  let btnsBlock = $('.freecalc .calc-actions__tabs');
  if (!is_elem(btnsBlock))
    return console.log('Action btn not found');
  let isClick = true;
  let modalSend = startModal();


  /* ------------------------ */
  // Clicks to: save, print, send
  /* ------------------------ */
  btnsBlock.on('click touchstart', 'button', function (evt) {
    evt.preventDefault();
    if (!isClick){
      return;
    }
    isClick = false;
    let $btn = $(this);
    // lock
    $btn.addClass('not-active');
    //
    let btnAction = $btn.attr('name');

    if (btnAction==='save' || btnAction === 'print'){
      let send = getDataToSend(btnAction);

      sendResponse(send, (res)=>{
        if (res.url){
          isClick = true;
          btnsBlock.find('.not-active').removeClass('not-active');
          //window.open(res.url);
          window.location.href = res.url;
        }
      });
    }
    else if ($btn.attr('name')==='send'){
      // Отправить нам
      isClick = true;
      $btn.removeClass('not-active');
      modalSend.open();
    }
  });


  /* ------------------------ */
  // Popup close
  /* ------------------------ */
  $('.freecalc-popup .close').on('click touchstart', function (evt) {
    modalSend.close();
    isClick = true;
    btnsBlock.find('.not-active').removeClass('not-active');
  });


  /* ------------------------ */
  // Popup send
  /* ------------------------ */
  $('.freecalc-popup form.content').on('submit', function (evt) {
    evt.preventDefault();
    let popup = $(this).parents('.tingle-modal-box');
    let name = $(this).find('[name="name"]').val();
    let tel = $(this).find('[name="tel"]').val();
    let sectionName = $('.freecalc-tab.active .freecalc-tab__link').text();
    sectionName = sectionName.trim();


    if (!tel && !name)
      return false;
    let data = {
      user_name: name,
      user_tel: tel,
    };
    let send = getDataToSend('send');
    send.data.user_name = name;
    send.data.user_tel = tel;
    send.data.section_name = sectionName;

    // send to us
    sendResponse(send, (res)=>{
      if (res.is_send){
        popup.addClass('success').find('.caption').text('Расчет успешно отправлен!');
        $(this).remove();
        setTimeout(function () {
          modalSend.close();
        },1000);
      }
      //console.log(res);
    });
  });


  /* ------------------------ */
  // Подготовить данные для отправки
  /* ------------------------ */
  function getDataToSend(btnAction) {

    let details = document.querySelectorAll('.freecalc__detailing .detailing');

    // Для отправки на сервер
    let totalEl = document.querySelector('.freecalc__footer .total-sum');
    let totalText = '';
    if (is_elem(totalEl))
      totalText = escapeHtml(totalEl.innerHTML);
    let obj = {};

    // Результаты с таблицы детализации
    details.forEach(function (el, idx) {
      // "material-js" etc
      let key = el.classList[1];
      obj[key] = {};
      let propEl = el.querySelector('.detailing__prop');
      let priceEl = el.querySelector('.detailing__price');
      let propText = escapeHtml(propEl.innerHTML);
      let priceText = '';
      if (is_elem(priceEl))
        priceText = escapeHtml(priceEl.innerHTML);



      /*propEl.forEach((el)=>{
        propText += el.textContent;
      });*/

      obj[key].prop = propText;
      obj[key].price = priceText;
    });

    // Выбранная столешница
    let worktop = $('.worktop-comp.active');

    // Размеры столешницы
    let size = {};
    // 1
    let w1 = worktop.find('.w1');
    if (is_elem(w1))
      size.w1 = parseInt(w1.val()) || 0;
    // 2
    let w2 = worktop.find('.w2');
    if (is_elem(w2))
      size.w2 = parseInt(w2.val()) || 0;
    // 3
    let w3 = worktop.find('.w3');
    if (is_elem(w3))
      size.w3 = parseInt(w3.val()) || 0;
    // l1
    let l1 = worktop.find('.l1');
    if (is_elem(l1))
      size.l1 = parseInt(l1.val()) || 0;
    // l2
    let l2 = worktop.find('.l2');
    if (is_elem(l2))
      size.l2 = parseInt(l2.val()) || 0;
    // l3
    let l3 = worktop.find('.l3');
    if (is_elem(l3))
      size.l3 = parseInt(l3.val()) || 0;

    let worktopIMG = worktop.data('component');
    let checkName = $('.component.check-worktop.active').find('.text').text();

    // Выбраные углы
    let radial = [];
    let radials = worktop.find('.radial-group > label');
    radials.each(function (idx) {
      if (is_elem($(this).find('input:checked'))){
        radial.push(1);
      }
      else{
        radial.push(0);
      }
    });

    // Варочная панель
    let cpanel = null;
    let cpanelEl = worktop.find('.check-panel:checked');
    if (is_elem(cpanelEl))
      cpanel = 1;
    let dataOther = {};
    dataOther.total_price = totalText || '0р.';
    dataOther.wname = checkName;
    dataOther.wimg = worktopIMG;
    dataOther.size = size;
    dataOther.cpanel = cpanel;
    dataOther.radial = radial;

    /*obj.data = {};
    obj.data.total_price = totalText || '0р.';
    obj.data.wname = checkName;
    obj.data.wimg = worktopIMG;
    obj.data.size = size;
    obj.data.cpanel = cpanel;
    obj.data.radial = radial;*/

    // Для отправки
    return{
      action_user: btnAction,
      details: obj,
      data: dataOther,
      size: size,
    };
  }


  // *****
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


  /** Отправить запрос */
  function sendResponse(data, success) {
    let url = freeCalcName.url;

    data.nonce = freeCalcName.nonce;
    //data.action = action;
    data.action = 'freecalc_interactive';
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


  /** html_encode */
  function escapeHtml(text) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
  }


  /** modal */
  function startModal() {
    let contentModal = document.querySelector('template.f-modal-send').content;

    var modal = new tingle.modal({
      footer: false,
      closeMethods: ['overlay', 'button', 'escape'],
      closeLabel: "Close",
      cssClass: ['freecalc-popup'],
      onOpen: function() {
        //console.log('modal open');
      },
      onClose: function() {
        /*isClick = true;
        btnsBlock.find('.not-active').removeClass('not-active');*/
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

  /** Ожидание при клика на кнопку */
  function whiteSend(flag, el) {

  }
})(jQuery);