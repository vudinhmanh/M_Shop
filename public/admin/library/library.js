(function($){
  "use strict";
  var VM = {};
  var _token = $('meta[name="csrf-token"]').attr('content');
  VM.switchery = () =>{
    $('.js-switch').each(function(){
      var switchery = new Switchery(this, { color: '#1AB394', size:'small'});
    })
  }
  // chọn tất cả các phần tử có class là setupSelect2 và khởi tạo thư viện Select2
  VM.select2 = () => {
    if($('.setupSelect2').length){
      $('.setupSelect2').select2();
    }
  }
  VM.changeStatus = () => {
    $(document).on('change', '.status', function(e){
      let _this = $(this);
      let option = {
        'value': _this.val(),
        'modelId': _this.attr('data-modelId'),
        'model': _this.attr('data-model'),
        'field': _this.attr('data-field'),
        '_token': _token
      }
      $.ajax({
        url: '/ajax/dashboard/changeStatus',
        type: 'POST',
        data: option,
        dataType: 'json',
        success: function(res) {
          let inputValue = ((option.value == 1)?2:1);
          if(res.flag == true){
            _this.val(inputValue);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log('Lỗi' + textStatus + '' + errorThrown)
        }
      })
      console.log(option);
      e.preventDefault();
    });
  }

  VM.changeStatusAll = () => {
    if($('.changeStatusAll').length){
      $(document).on('click', '.changeStatusAll', function(e) {
        let _this = $(this);
        let id = [];
        $('.checkBoxItem').each(function(){
          let checkBox = $(this);
          if(checkBox.prop('checked')){
            id.push(checkBox.val());  
          }
        });
        let option = {
          'value': _this.attr('data-value'),
          'model': _this.attr('data-model'),
          'field': _this.attr('data-field'),
          'id':id,
          '_token': _token
        }

        $.ajax({
          url: '/ajax/dashboard/changeStatusAll',
          type: 'POST',
          data: option,
          dataType: 'json',
          success: function(res) {
            if(res.flag == true){
                let cssActive1 = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                let cssActive2 = 'left: 20px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);';
                let cssUnActive = 'box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;'
                let cssUnActive2 = 'left: 0px; transition: background-color 0.4s, left 0.2s;'
                for(let i = 0; i < id.length; i++){
                  if(option.value == 2){
                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssActive1).find('small').attr('style', cssActive2)
                  }else if(option.value == 1){
                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssUnActive).find('small').attr('style', cssUnActive2)
                  }
                }
            }
        },
          error: function(jqXHR, textStatus, errorThrown){
            console.log('Lỗi' + textStatus + '' + errorThrown)
          }
        })
        e.preventDefault();
      })
    }
  }

  VM.checkAll = () => {
    if($('#checkAll').length){
      $(document).on('click', '#checkAll', function(){
        let isChecked = $(this).prop('checked')
        $('.checkBoxItem').prop('checked', isChecked);
        $('.checkBoxItem').each(function(){
          let _this = $(this);
          VM.changeBackground(_this);
        })
      })
    }
  }

  VM.checkBoxItem = () => {
    if($('.checkBoxItem').length){
      $(document).on('click', '.checkBoxItem', function(){
        let _this = $(this);
        VM.changeBackground(_this);
        VM.allChecked();
      });
    }
  }
  VM.changeBackground = (object) => {
    let isChecked = object.prop('checked')
    if(isChecked){
      object.closest('tr').addClass('important-bg-yellow')
    }else{
      object.closest('tr').removeClass('important-bg-yellow')
    }
  }

  VM.allChecked = () => {
    let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
    $('#checkAll').prop('checked', allChecked);
  }

  $(document).ready(function(){
    VM.switchery();
    VM.select2();
    VM.changeStatus();
    VM.checkAll();
    VM.checkBoxItem();
    VM.allChecked();
    VM.changeStatusAll();
  });
})(jQuery);