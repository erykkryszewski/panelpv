import $ from 'jquery';

$('document').ready(function(){
  if($('.faq__question').length > 0) {
    $('.faq__question').on('click', function(){
      $(this).next().slideToggle();
    });
  }
});