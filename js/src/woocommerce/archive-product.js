import $ from 'jquery';

$(document).ready(function() {
  function moveHeaderToFirst() {
    let archiveTitle = $('.woocommerce-products-header');
    let parentContainer = $('#primary main#main.site-main');
    if (archiveTitle.length > 0 && parentContainer.length > 0) {
      parentContainer.prepend(archiveTitle);
    }
  }

  moveHeaderToFirst();

  $(document).ajaxComplete(function() {
    moveHeaderToFirst(); 
  });
});
