import $ from 'jquery';

// $(document).ready(function() {
//   function showPopup(selector) {
//     $(selector).css('display', 'flex');
//   }

//   function closePopup(selector) {
//     $(selector).css('display', 'none');
//   }

//   function shouldShowNewsletterPopup() {
//     const url = window.location.href;
//     return !/kursy|sklep|koszyk|kasa|produkt/.test(url) && !sessionStorage.getItem('newsletterPopupShown');
//   }

//   function shouldShowShopPopup() {
//     const url = window.location.href;
//     const discountShownTimestamp = localStorage.getItem('discountShownTimestamp');
//     const currentTime = new Date().getTime();
//     const oneMonthInMilliseconds = 30 * 24 * 60 * 60 * 1000;

//     const canShowDiscount = !discountShownTimestamp || (currentTime - discountShownTimestamp > oneMonthInMilliseconds);

//     return !/sklep|produkt|koszyk|kasa/.test(url) && localStorage.getItem('shopVisited') && canShowDiscount && !sessionStorage.getItem('shopPopupShown');
//   }

//   // Newsletter Popup Logic
//   if (shouldShowNewsletterPopup()) {
//     setTimeout(function() {
//       showPopup('.popup--newsletter');
//     }, 8000);
//   }

//   $('#popup-close-newsletter').on('click', function() {
//     closePopup('.popup--newsletter');
//     sessionStorage.setItem('newsletterPopupShown', 'true');
//   });

//   // Shop Popup Logic
//   const currentUrl = window.location.href;
  
//   if (/sklep|produkt/.test(currentUrl)) {
//     localStorage.setItem('shopVisited', 'true');
//   } else if (shouldShowShopPopup()) {
//     setTimeout(function() {
//       showPopup('.popup--shop');
//     }, 30000);
//   }

//   $('#popup-close-shop').on('click', function() {
//     closePopup('.popup--shop');
//     sessionStorage.setItem('shopPopupShown', 'true');
//     localStorage.setItem('discountShownTimestamp', new Date().getTime());
//   });

//   // Copy Code to Clipboard
//   $('.popup__copy').on('click', function() {
//     const code = $('.popup__code').text().trim();
//     navigator.clipboard.writeText(code).then(function() {
//       $('.popup__copy').text('Skopiowano');
//     });
//   });
// });
