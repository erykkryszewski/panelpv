window.addEventListener('DOMContentLoaded', () => {
  const tracks = document.querySelectorAll('.logos__items');
  if (!tracks || tracks.length === 0) return;

  tracks.forEach((track, i) => {
    // base speed
    const baseSpeed = parseFloat(track.getAttribute('data-speed') || '140');

    // every next is a bit slower
    const multiplier = 1 - i * 0.05;
    const speed = baseSpeed * multiplier;

    const totalWidth = track.scrollWidth;
    if (!totalWidth) return;

    const distance = totalWidth / 2;
    const duration = distance / speed;

    track.style.setProperty('--duration', `${duration}s`);
    track.style.animationDelay = `${i * 0.5}s`;
  });
});
