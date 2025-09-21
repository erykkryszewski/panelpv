import $ from 'jquery';

$(document).ready(function(){
  if($('.cta-hero__wrapper')) {
    $('.cta-hero__wrapper').slick({
      dots: false,
      arrows: false,
      infinite: false,
      speed: 850,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      infinite: true,
      swipe: false,
      pauseOnHover: false,
      pauseOnFocus: false,
      draggable: false,
      cssEase: 'ease-out',
      fade: true,
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
  
    // reset buttons text
    $(".slick-prev").text("");
    $(".slick-next").text("");
    $("ul.slick-dots > li > button").text("");


    // parallax function

    let heroImage = document.querySelector('.cta-hero__image img');

    if (heroImage) {
      $(window).scroll(function() {
        var scrollPosition = $(this).scrollTop();
        if (scrollPosition > 50) {
          $(heroImage).addClass('scrolled');
        } else {
          $(heroImage).removeClass('scrolled');
        }
      });
    }
  }
});