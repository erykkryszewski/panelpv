import $ from 'jquery';

$(document).ready(function() {
  $('.program__nav > button').on('click', function(){
    let filter_id = $(this).attr('data-id');
    
    $('.program__nav > button').removeClass('active');
    $(this).addClass('active');
    $('.program__item').fadeOut();
    setTimeout(function(){
      $('#'+filter_id).fadeIn();
    }, 500)

    if (window.matchMedia('(max-width: 991px)').matches) {
      $('html, body').animate({
        scrollTop: $(this).offset().top - 150
      }, 1000);
    }
  })
});
