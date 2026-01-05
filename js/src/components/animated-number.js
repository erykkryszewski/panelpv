document.addEventListener('DOMContentLoaded', () => {
  const ercodingAnimatedCircles = document.querySelectorAll('.animated-number__circle');

  if (!ercodingAnimatedCircles.length) return;

  const ercodingHandleIntersection = (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const target = entry.target;
        const dasharrayValue = target.getAttribute('data-dasharray');
        target.style.setProperty('--dasharray', dasharrayValue);
        target.classList.add('animated-number__circle--animated');
        observer.unobserve(target);
      }
    });
  };

  const ercodingObserver = new IntersectionObserver(ercodingHandleIntersection, {
    root: null,
    threshold: 0.1,
  });

  ercodingAnimatedCircles.forEach((element) => ercodingObserver.observe(element));
});
