import $ from 'jquery';

// mobile navigation

$('document').ready(function() {
  $('.hamburger').on('click', function() {
    $(this).toggleClass('active');
    $('.header').toggleClass('header--open');
    $('.nav').toggleClass('nav--open');
    $('.nav__menu').toggleClass('nav__menu--open');
    $('.nav .sub-menu').toggleClass('sub-menu--open');
    $('.nav__button').toggleClass('nav__button--open');
    $('.nav__hamburger').toggleClass('nav__hamburger--open');
    $('.nav__menu').slideToggle();
  });
  
  $('.menu-item-has-children > a').on('click', function(e){
    e.preventDefault();
    if (window.matchMedia('(max-width: 1199px)').matches) {
      $(this).siblings('ul').slideToggle(); 
    }
  });

  $('.nav__menu li > a').on('click', function(){
    if (window.matchMedia('(max-width: 1199px)').matches && !$(this).parent().hasClass('menu-item-has-children')) {
      $('.nav__menu').slideUp();
      $('.menu-item-has-children > a').siblings('ul').slideUp(); 
      $('.hamburger').removeClass('active');
    }
  });

  if($('body').hasClass('theme-subpage')) {
    $('.nav__menu > li a').each(function(){
      let currentHref = $(this).attr('href');
      let hrefFirstLetter = $(this).attr('href').charAt(0);

      if(hrefFirstLetter == '#') {
        $(this).attr('href', '/' + currentHref);
      }
    });
  }

  // Reset navigation styles on window resize
  $(window).resize(function() {
    if ($(window).width() > 1199) {
      // Reset the styles affected by slideToggle
      $('.nav__menu').removeAttr('style');
      $('.menu-item-has-children > ul').removeAttr('style');

      // Remove classes added for mobile view
      $('.hamburger').removeClass('active');
      $('.header').removeClass('header--open');
      $('.nav').removeClass('nav--open');
      $('.nav__menu').removeClass('nav__menu--open');
      $('.nav .sub-menu').removeClass('sub-menu--open');
      $('.nav__button').removeClass('nav__button--open');
      $('.nav__hamburger').removeClass('nav__hamburger--open');
    }
  });
});

// add "/" before "#" to nav elements on subpages