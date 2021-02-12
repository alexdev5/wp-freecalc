(function ($) {

  /* ------------------------ */
  // Клики по кнопкам
  /* ------------------------ */
  let btnsBlock = $('.freecalc .calc-actions__tabs');
  if (!is_elem(btnsBlock))
    return console.log('Action btn not found');

  let isClick = true;

  //
  btnsBlock.on('click', 'button', function (evt) {
    evt.preventDefault();
    if (!isClick){
      return;
    }
    isClick = false;
    let $btn = $(this);
    // lock
    //btnsBlock.find('button').addClass('not-active');
    $btn.addClass('not-active');
    //
    let btnAction = $btn.attr('name');
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

    if ($btn.attr('name')==='save'){
      // Сохранить
    }
    else if ($btn.attr('name')==='send'){
      // Отправить нам

    }
    else if ($btn.attr('name')==='print'){
      // распечатать

    }

    // Выбранная столешница
    let worktopIMG = $('.worktop-comp.active').data('component');
    let worktopName = $('.component.check-worktop.active').find('.text').text();


    obj.total_price = totalText || '0р.';
    obj.worktop_name = worktopName;
    obj.worktop_imgname = worktopIMG;
    // Для отправки
    let send = {
      action_user: btnAction,
      details: obj,
    };

    //console.log();
    ///return;
    sendResponse(send, (res)=>{
      /*if( res.hasOwnProperty('error') && res.error==='ok' ){
        $('.waiting-load').remove();
        console.log(res);
        return ;
      }*/

      if (res.url){
        isClick = true;
        btnsBlock.find('.not-active').removeClass('not-active');
        window.open(res.url);
       // window.location.href = res.url;
      }
    });
  });

  //

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


  /* Отправить запрос */
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
})(jQuery);