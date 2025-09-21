document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".ercodingtheme-phone-number").forEach(function (ercodingEl) {
    let ercodingPhoneText = ercodingEl.textContent.replace(/\D+/g, "");
    
    if (ercodingPhoneText.startsWith("48") && ercodingPhoneText.length === 11) {
      ercodingPhoneText = `+${ercodingPhoneText}`;
    } else if (!ercodingPhoneText.startsWith("+48") && ercodingPhoneText.length === 9) {
      ercodingPhoneText = `+48${ercodingPhoneText}`;
    }

    let match = ercodingPhoneText.match(/^\+48(\d{3})(\d{3})(\d{3})$/);
    if (match) {
      ercodingEl.textContent = `+48 ${match[1]} ${match[2]} ${match[3]}`;
    }
  });
});
