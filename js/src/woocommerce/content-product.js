import $ from 'jquery';

$(document).ready(function() {
  function wrapProductElements() {
    $('.products > li > a > img').each(function() {
      $(this).wrap('<div class="product__image"></div>');
    });
    
    $('.products > li > a.button.product__button').each(function() {
      $(this).wrap('<div class="product__button-wrapper"></div>');
    });
  }

  wrapProductElements(); 

  $(document).ajaxComplete(function() {
    wrapProductElements();
  });
});
