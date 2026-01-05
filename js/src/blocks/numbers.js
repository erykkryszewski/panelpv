import $ from 'jquery';

$(window).scroll(function () {
  $('.numbers__wrapper').each(function (index, element) {
    let $wrapper = $(element);
    let oTop1 = $wrapper.offset().top - window.innerHeight;

    if (!$wrapper.data('animated') && $(window).scrollTop() > oTop1) {
      $wrapper.find('.numbers__digit').each(function () {
        let $this = $(this),
          countTo = $this.attr('data-count');
        $({
          countNum: $this.text(),
        }).animate(
          {
            countNum: countTo,
          },
          {
            duration: 2000,
            easing: 'swing',
            step: function () {
              $this.text(formatNumber(Math.floor(this.countNum)));
            },
            complete: function () {
              $this.text(formatNumber(this.countNum));
            },
          },
        );
        $this.css('opacity', '1');
      });
      $wrapper.data('animated', true);
    }
  });
});

function formatNumber(num) {
  let numStr = num.toString();
  if (numStr.length === 5) {
    return numStr.replace(/(\d{2})(\d{3})/, '$1 $2');
  }
  return numStr;
}
