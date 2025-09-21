import $ from 'jquery';
import { gsap } from "gsap";
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// $.fn.isInViewport = function () {
//   var elementTop = $(this).offset().top + 200;
//   var elementBottom = elementTop + $(this).outerHeight();
//   var viewportTop = $(window).scrollTop();
//   var viewportBottom = viewportTop + $(window).height();

//   return elementBottom > viewportTop && elementTop < viewportBottom;
// };

// $(window).on('resize scroll', function () {
//   let cta = $('.cta');

//   if(cta.length > 0) {
//     if (cta.isInViewport()) {
//       cta.addClass('cta--started');
//     }
//   }
// });

// $(document).ready(function() {
//   gsap.registerPlugin(ScrollTrigger);

//   let cta = $('.cta__wrapper');
  
//   gsap.fromTo(cta.children(), { y: 100, opacity: 0 }, {y: 0, opacity: 1, stagger: 0.1, duration: 1, scrollTrigger: {
//     trigger: cta,
//     start: 'top 90%',
//     // markers: true
//   }}
//   )
// });