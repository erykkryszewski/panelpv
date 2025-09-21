import $ from 'jquery'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

$(document).ready(() => {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return

  const mm = gsap.matchMedia()

  const animateDecorators = ({ start, end, yEnd, scrub }) => {
    $('.theme-blog').each((i, section) => {
      const $decorator = $(section).find('.theme-blog__decorator').first()
      if (!$decorator.length) return
      gsap.set($decorator, { yPercent: 100 })
      gsap.to($decorator, {
        yPercent: yEnd,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: section,
          start,
          end,
          scrub,
          invalidateOnRefresh: true,
          id: `decorator-${i}`
        }
      })
    })
  }

  mm.add('(max-width: 991px)', () => {
    animateDecorators({
      start: 'top 80%',
      end: 'bottom 30%',
      yEnd: 55,
      scrub: 0.6
    })
  })

  mm.add('(min-width: 992px)', () => {
    animateDecorators({
      start: 'top bottom',
      end: 'bottom top',
      yEnd: -25,
      scrub: 0.6
    })
  })

  $(window).on('load', () => ScrollTrigger.refresh())
})
