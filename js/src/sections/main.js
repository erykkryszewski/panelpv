import $ from 'jquery';

// get footer height and set main min height

$(document).ready(function(){
  let headerHeight = $('.header').height(); // 60 is a footer margin top
  let footerHeight = $('.footer').height() + 60; // 60 is a footer margin top
  let footerHeightWithAdminBar = $('.footer').height() + 60 + 32; // 60 is a footer margin top
  let main = $('main#main');

  if($('body').hasClass('admin-bar')) {
    main.css({ 
      minHeight: 'calc(100vh - ' + footerHeightWithAdminBar +'px)', 
      paddingTop: headerHeight 
    });
  } else {
    main.css({ 
      minHeight: 'calc(100vh - ' + footerHeight + 'px)', 
      paddingTop: headerHeight 
    });
  }
});