import $ from 'jquery';

$(document).ready(function(){
  if($('.gallery__slider')) {
    $('.gallery__slider').slick({
      dots: false,
      arrows: false,
      infinite: false,
      speed: 550,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      pauseOnHover: false,
      pauseOnDotsHover: false,
      pauseOnFocus: false,
      cssEase: 'ease-out',
      swipe: false,
      draggable: false,
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  
    $(".slick-prev").text("");
    $(".slick-next").text("");
    $("ul.slick-dots > li > button").text("");
  }
});