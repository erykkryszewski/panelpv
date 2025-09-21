import $ from 'jquery';

$(document).ready(function() {
  if ($('body').hasClass('woocommerce-cart')) {
    const shopHeroHTML = `
      <div class="shop-hero">
        <div class="container">
          <h1 class="shop-hero__title">Koszyk</h1>
        </div>
      </div>
    `;

    $('main#main').prepend(shopHeroHTML);

    // Function to update the cart and then perform an action
    function updateCartAndRedirect(targetUrl) {
      const updateCartButton = $('button.button--update-cart');
      if (updateCartButton.length && !updateCartButton.prop('disabled')) {
        // Trigger the cart update button click
        updateCartButton.click();

        // Wait for the update to complete (using WooCommerce hooks)
        $(document).ajaxStop(function() {
          window.location.href = targetUrl;
        });
      } else {
        // If no update needed, redirect immediately
        window.location.href = targetUrl;
      }
    }

    // Handle "Continue Shopping" button
    $('a.button--continue-shopping').on('click', function(event) {
      event.preventDefault();
      const targetUrl = $(this).attr('href');
      updateCartAndRedirect(targetUrl);
    });

    // Handle "Checkout" button
    $('a.button--checkout').on('click', function(event) {
      event.preventDefault();
      const targetUrl = $(this).attr('href');
      updateCartAndRedirect(targetUrl);
    });
  }
});
