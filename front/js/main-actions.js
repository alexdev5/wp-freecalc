(function ($) {

  /* ------------------------ */
  // Клики по кнопкам
  /* ------------------------ */
  let btnsBlock = $('.freecalc .calc-actions__tabs');
  if (!is_elem(btnsBlock))
    return console.log('Action btn not found');

  //
  btnsBlock.on('click', 'button', function (evt) {
    evt.preventDefault();
    let $btn = $(this);
    let btnAction = $btn.attr('name');

    if ($btn.attr('name')==='save'){
      // Сохранить
    }
    else if ($btn.attr('name')==='send'){
      // Отправить нам

    }
    else if ($btn.attr('name')==='print'){
      // распечатать

    }
    //return ;
    sendResponse({action_user: btnAction}, (res)=>{
      /*if( res.hasOwnProperty('error') && res.error==='ok' ){
        $('.waiting-load').remove();
        console.log(res);
        return ;
      }*/

      if (res.url){
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
})(jQuery);