import $ from 'jquery';

$(document).ready(function(){
  $('.woocommerce-product-gallery, .summary').wrapAll('<div class="single-product-content"></div>');
});

$(document).ready(function(){
  if($('.single-product-content .flex-control-nav')) {
    $('.single-product-content .flex-control-nav').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 550,
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 5000,
      cssEase: 'ease-out',
      responsive: [
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 5
          }
        }
      ]
    });
  
    $(".slick-prev").text("");
    $(".slick-next").text("");
    $("ul.slick-dots > li > button").text("");
  }
});