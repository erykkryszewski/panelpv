import $ from 'jquery';

$(document).ready(function(){
  if($('.hero-slider__wrapper')) {
    $('.hero-slider__wrapper').slick({
      dots: true,
      arrows: false,
      speed: 800,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4500,
      infinite: true,
      swipe: false,
      pauseOnHover: false,
      pauseOnFocus: true,
      pauseOnDotsHover: true,
      // vertical: true,
      // verticalSwiping: true,
      cssEase: 'ease-out',
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 1
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });

    // initial animations when window loads
    if($('.slick-current.slick-active .hero-slider__title').length > 0) {
      setTimeout(function(){
        $('.slick-current.slick-active .hero-slider__title').addClass('hero-slider__title--animated');
      }, 1000);
    }

    if($('.slick-current.slick-active .hero-slider__content > p').length > 0) {
      setTimeout(function(){
        $('.slick-current.slick-active .hero-slider__content > p').addClass('animated');
      }, 1200);
    }

    if($('.slick-current.slick-active .hero-slider__button').length > 0) {
      setTimeout(function(){
        $('.slick-current.slick-active .hero-slider__button').addClass('hero-slider__button--animated');
      }, 1400);
    }

    // animations on every slide when slider changes
    $('.hero-slider__wrapper').on('afterChange', function(event, slick, currentSlide, nextSlide){  

      // reset everything to allow animations start from scratch
      setTimeout(function(){
        if($('.slick-slide .hero-slider__title').length > 0) {
          $('.slick-slide .hero-slider__title').removeClass('hero-slider__title--animated');
        }

        if($('.slick-slide .hero-slider__content > p').length > 0) {
          $('.slick-slide .hero-slider__content > p').removeClass('animated');
        }

        if($('.slick-slide .hero-slider__button').length > 0) {
          $('.slick-slide .hero-slider__button').removeClass('hero-slider__button--animated');
        }
      }, 100);

      // title animation
      if($('.slick-current.slick-active .hero-slider__title').length > 0) {
        setTimeout(function(){
          $('.slick-current.slick-active .hero-slider__title').addClass('hero-slider__title--animated');
        }, 300);
      }
  
      // text animation
      if($('.slick-current.slick-active .hero-slider__content > p').length > 0) {
        setTimeout(function(){
          $('.slick-current.slick-active .hero-slider__content > p').addClass('animated');
        }, 500);
      }
  
      // button animation
      if($('.slick-current.slick-active .hero-slider__button').length > 0) {
        setTimeout(function(){
          $('.slick-current.slick-active .hero-slider__button').addClass('hero-slider__button--animated');
        }, 700);
      }
    });
  
    // reset buttons text
    $(".slick-prev").text("");
    $(".slick-next").text("");
    $("ul.slick-dots > li > button").text("");
  }
});