import $ from 'jquery';

$(document).ready(function($) {
  
  $('.iframe__link--file').on('click', function(e) {
    e.preventDefault();

    var videoSrc = $(this).attr('href');
    var videoHeight = $(this).closest('.iframe__overlay').css('height');

    // Dynamically create the video element
    var videoElement = $('<video controls></video>').css({
      width: '100%',
      height: videoHeight
    }).append($('<source>', {
      src: videoSrc,
      type: 'video/mp4'
    }));

    // Create a placeholder div to hold the video for Fancybox
    var placeholder = $('<div></div>').append(videoElement).hide().appendTo('body');

    // Trigger Fancybox with the dynamically created video element
    $.fancybox.open({
      src: placeholder,
      type: 'inline',
      afterClose: function() {
        placeholder.remove();
      }
    });
  });
  
});
