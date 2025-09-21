import $ from 'jquery';

$(document).ready(function(){
  if ($('body').hasClass('woocommerce-checkout')) {
    const shopHeroHTML = `
      <div class="shop-hero">
        <div class="container">
          <h1 class="shop-hero__title">Kasa</h1>
        </div>
      </div>
    `;

    $('main#main').prepend(shopHeroHTML);
  }
});
