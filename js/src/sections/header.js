import $ from 'jquery';

$(window).scroll(function(){
  if ($(window).scrollTop() >= 50) {
    $('.header').addClass('header--fixed');
    $('.nav').addClass('nav--fixed');
    $('.nav__logo').addClass('nav__logo--fixed');
    $('.nav__menu').addClass('nav__menu--fixed');
    $('.nav .sub-menu').addClass('sub-menu--fixed');
    $('.nav__button').addClass('nav__button--fixed');
    $('.nav__hamburger').addClass('nav__hamburger--fixed');
  }
  else {
    $('.header').removeClass('header--fixed');
    $('.nav').removeClass('nav--fixed');
    $('.nav__logo').removeClass('nav__logo--fixed');
    $('.nav__menu').removeClass('nav__menu--fixed');
    $('.nav .sub-menu').removeClass('sub-menu--fixed');
    $('.nav__button').removeClass('nav__button--fixed');
    $('.nav__hamburger').removeClass('nav__hamburger--fixed');
  }
});