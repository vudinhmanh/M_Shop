(function($){
  "use strict";
  var VM = {};
  VM.seoPreview = () => {
    $('input[name=meta_title]').on('keyup', function(){
      let input = $(this);
      let value = input.val();
      $('.meta_title').html(value);
    });
    $('input[name=canonical]').css({
      'padding-left': $('.baseUrl').outerWidth() + 5
    })
    $('input[name=canonical]').on('keyup', function(){
      let input = $(this);
      let value = VM.removeUtf8(input.val())
      $('.canonical').html(BASE_URL + value + SUFFIX);
    });
    $('textarea[name=meta_description]').on('keyup', function(){
      let input = $(this);
      let value = input.val();
      $('.meta_description').html(value);
    });
  }  
  VM.removeUtf8 = (str) => {
    str = str.toLowerCase(); // chuyen ve ki tu biet thuong
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|,|\.|\:|\;|\'|\–| |\"|\&|\#|\[|\]|\\|\/|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");
    return str;
  }
  $(document).ready(function(){ 
    VM.seoPreview();
  })

})(jQuery);