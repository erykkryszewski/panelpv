import $ from 'jquery';

$(document).ready(function() {
  const $counter = $('.counter');
  if ($counter.length) {
    const count_down = new Date($counter.find('.counter__time-wrapper').attr('id')).getTime();
    const elements = {
      day: $counter.find('.counter__day'),
      hour: $counter.find('.counter__hour'),
      minute: $counter.find('.counter__minute'),
      second: $counter.find('.counter__second')
    }
    const interval = setInterval(function() {
      const now = new Date().getTime();
      const distance = count_down - now;
      if (distance < 0) {
        Object.values(elements).forEach(el => el.text('0'));
        // Fade out the whole counter section when countdown is done
        $counter.fadeOut('slow', function() {
          // Optionally, remove the counter from the DOM after fading out
          // $(this).remove();
        });
        clearInterval(interval); // Stop the interval when countdown is done
        return;
      }
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Update text without fading out elements
      elements.day.text(days >= 0 ? days : '0');
      elements.hour.text(hours >= 0 ? hours : '0');
      elements.minute.text(minutes >= 0 ? minutes : '0');
      elements.second.text(seconds >= 0 ? seconds : '0');

      // Check if the countdown has reached zero across all units
      if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
        $counter.fadeOut('slow', function() {
          // Optionally, remove the counter from the DOM after fading out
          // $(this).remove();
        });
        clearInterval(interval); // Ensure we stop the interval
      }
    }, 1000); 
  }
});
