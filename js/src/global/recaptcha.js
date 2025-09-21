import $ from 'jquery';

$(document).ready(function(){
  $('.gform_body input').on('focus', function() {
    var recaptchaScript = document.createElement('script');
    recaptchaScript.src = 'https://www.google.com/recaptcha/api.js?hl=pl&amp;render=explicit&amp;ver=5.6.1';
    recaptchaScript.defer = true;
    document.body.appendChild(recaptchaScript);
  });
});
