// モーダル部分（つぶやき）
$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      console.log(target);
      var modal = document.getElementById(target);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.modalClose').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});

// アコーディオン機能
$(function () {
  $(".js-accordion").click(function () {
    $(".menu").toggleClass("active");
    $(".arrow-bottom").toggleClass("reverse");
  });
});
