import $ from 'jquery';

$(document).ready(function () {
  if ($('.testimonials__slider')) {
    $('.testimonials__slider').slick({
      dots: true,
      arrows: false,
      infinite: true,
      speed: 550,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      cssEase: 'ease-out',
      infinite: true,
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });

    $('.slick-prev').text('');
    $('.slick-next').text('');
    $('ul.slick-dots > li > button').text('');
  }
});

// hide testimonials if not filled

$(document).ready(function () {
  if ($('.testimonials--hidden').length && !$('body').hasClass('block-editor-page')) {
    const testimonialsSection = $('.testimonials--hidden');
    testimonialsSection.hide();

    const prev1 = testimonialsSection.prev();
    if (prev1.hasClass('default-block')) {
      prev1.hide();
      const prev2 = prev1.prev();
      if (prev2.hasClass('section-title')) {
        prev2.hide();
      }
    } else if (prev1.hasClass('section-title')) {
      prev1.hide();
      const prev2 = prev1.prev();
      if (prev2.hasClass('default-block') && prev2.hasClass('container-fluid')) {
        prev2.hide();
      }
    }

    const next1 = testimonialsSection.next();
    if (next1.hasClass('default-block')) {
      next1.hide();
    }
  }
});
