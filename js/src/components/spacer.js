import $ from 'jquery';

let spacer = $('.spacer');
let spacerContainer = $('.spacer').parent();

$(document).ready(function(){
  if(spacer.length > 0) {
    spacerContainer.addClass('container-fluid');
    spacerContainer.removeClass('container');
  }
});