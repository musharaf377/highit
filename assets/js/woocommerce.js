(function ($) {
  $(document).ready(function () {
    // Function to update cart count
    $(document).on("click", ".ajax-add-to-cart", function (e) {
      e.preventDefault();

      var button = $(this);
      var product_id = button.data("product_id");

      button.prop("disabled", true); // Disable button to prevent multiple clicks

      $.ajax({
        type: "POST",
        url: wc_add_to_cart_params.ajax_url,
        data: {
          action: "custom_ajax_add_to_cart",
          product_id: product_id,
        },
        beforeSend: function () {
          button.text("Adding...");
        },
        success: function (response) {
          if (response.success) {
            button.text("Added");
            button.siblings(".added-message").fadeIn().delay(1500).fadeOut();
            updateCartCount(); // Update cart count dynamically
          } else {
            button.text("Failed");
          }
          setTimeout(function () {
            button.text("Add to Cart");
            button.prop("disabled", false);
          }, 2000);
        },
      });
    });

    // Function to Update Cart Count
    function updateCartCount() {
      $.ajax({
        type: "POST",
        url: wc_add_to_cart_params.ajax_url,
        data: { action: "get_cart_count" },
        success: function (response) {
          if (response.count !== undefined) {
            $(".cart-count").text(response.count);
          }
        },
      });
    }

    // Function to update wishlist count
    function updateWishlistCount() {
      $.ajax({
        url: wc_add_to_cart_params.ajax_url,
        type: "POST",
        data: { action: "get_wishlist_count" },
        success: function (response) {
          if (response.count !== undefined) {
            $(".wishlist-count").text(response.count);
          }
        },
      });
    }

    // Run updates on document ready
    updateCartCount();
    updateWishlistCount();

    // Hook into WooCommerce events to update cart
    $(document.body).on("added_to_cart removed_from_cart", function () {
      updateCartCount();
    });

    // Hook into YITH Wishlist events
    $(document).on("added_to_wishlist removed_from_wishlist", function () {
      updateWishlistCount();
    });

    /**
     * ------------------------------------
     * Get Delivery Info
     * ------------------------------------
     */

    // Check if geolocation is supported by the browser
    if (navigator.geolocation) {
      // Get the current position
      navigator.geolocation.getCurrentPosition(
        // Success callback function
        (position) => {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;

          $.ajax({
            type: "POST",
            url: wc_add_to_cart_params.ajax_url,
            data: {
              action: "musemind_get_shipping_info",
              latitude: latitude,
              longitude: longitude,
            },
            success: function (res) {
              if (res.data.free_shipping) {
                var freeShippingBtn = `<div class="btn-wrap">
					<button class="boxed-btn yellow-btn">
						<svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.16667 11.167C3.16667 11.609 3.34226 12.0329 3.65482 12.3455C3.96738 12.6581 4.39131 12.8337 4.83333 12.8337C5.27536 12.8337 5.69928 12.6581 6.01184 12.3455C6.3244 12.0329 6.5 11.609 6.5 11.167M3.16667 11.167C3.16667 10.725 3.34226 10.301 3.65482 9.98848C3.96738 9.67592 4.39131 9.50033 4.83333 9.50033C5.27536 9.50033 5.69928 9.67592 6.01184 9.98848C6.3244 10.301 6.5 10.725 6.5 11.167M3.16667 11.167H1.5V2.00033C1.5 1.77931 1.5878 1.56735 1.74408 1.41107C1.90036 1.25479 2.11232 1.16699 2.33333 1.16699H9.83333V11.167M6.5 11.167H11.5M11.5 11.167C11.5 11.609 11.6756 12.0329 11.9882 12.3455C12.3007 12.6581 12.7246 12.8337 13.1667 12.8337C13.6087 12.8337 14.0326 12.6581 14.3452 12.3455C14.6577 12.0329 14.8333 11.609 14.8333 11.167M11.5 11.167C11.5 10.725 11.6756 10.301 11.9882 9.98848C12.3007 9.67592 12.7246 9.50033 13.1667 9.50033C13.6087 9.50033 14.0326 9.67592 14.3452 9.98848C14.6577 10.301 14.8333 10.725 14.8333 11.167M14.8333 11.167H16.5V6.16699M16.5 6.16699H9.83333M16.5 6.16699L14 2.00033H9.83333" stroke="#3D3100" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg> Free Delivery</button></div>`;

                $(".musemind-product-info .delivery-info").append(
                  freeShippingBtn
                );
              }
            },
            error: function (err) {
              console.log(err);
            },
          });
        },
        // Error callback function
        (error) => {
          let errorMessage;

          switch (error.code) {
            case error.PERMISSION_DENIED:
              errorMessage = "User denied the request for geolocation.";
              break;
            case error.POSITION_UNAVAILABLE:
              errorMessage = "Location information is unavailable.";
              break;
            case error.TIMEOUT:
              errorMessage = "The request to get user location timed out.";
              break;
            case error.UNKNOWN_ERROR:
              errorMessage = "An unknown error occurred.";
              break;
          }

          console.error(`Error: ${errorMessage}`);
        },
        // Options object
        {
          enableHighAccuracy: true, // More accurate position
          timeout: 5000, // Time to wait for position (5 seconds)
          maximumAge: 0, // Always get fresh location
        }
      );
    } else {
      console.error("Geolocation is not supported by this browser.");
      document.getElementById("location").innerHTML =
        "Geolocation is not supported by your browser.";
    }

    /**
     * -------------------------------------------------
     * Single Product Page
     * -------------------------------------------------
     */

    var buyNowButtonUrl = $(".musemind-add-to-cart a.buy-now").attr(
      "href"
    );

    // Decrease Quantity
    $(document).on("click", ".quantity-box .decrease_qty", function (e) {
      var min_qty = parseInt($('input[name="quantity"]').attr("min"));

      var quantity = parseInt($('input[name="quantity"]').val());

      quantity--;

      if (quantity < min_qty) {
        return;
      }

      setProductQuantity(quantity);
    });

    // Increase Quantity
    $(document).on("click", ".quantity-box .increase_qty", function (e) {
      var max_qty = parseInt($('input[name="quantity"]').attr("max"));

      var quantity = parseInt($('input[name="quantity"]').val());

      quantity++;

      if (quantity > max_qty) {
        return;
      }

      setProductQuantity(quantity);
    });

    function setProductQuantity(quantity) {
      var urlWithQuantity = buyNowButtonUrl + "&quantity=" + quantity;

      $('input[name="quantity"]').val(quantity);

      $(".musemind-add-to-cart a.buy-now").attr("href", urlWithQuantity);
    }
  });

  /**
   * -------------------------
   * My Account page
   * -------------------------
   */
  var edit_account_icon =
    '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.17188 16.849C4.41938 16.0252 4.92584 15.3032 5.61612 14.79C6.3064 14.2768 7.14372 13.9997 8.00387 14H12.0039C12.8651 13.9997 13.7035 14.2774 14.3943 14.7918C15.085 15.3062 15.5913 16.0298 15.8379 16.855M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10ZM7 8C7 8.79565 7.31607 9.55871 7.87868 10.1213C8.44129 10.6839 9.20435 11 10 11C10.7956 11 11.5587 10.6839 12.1213 10.1213C12.6839 9.55871 13 8.79565 13 8C13 7.20435 12.6839 6.44129 12.1213 5.87868C11.5587 5.31607 10.7956 5 10 5C9.20435 5 8.44129 5.31607 7.87868 5.87868C7.31607 6.44129 7 7.20435 7 8Z" stroke="#4D5462" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

  var wishlist_icon =
    '<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4974 9.57169L9.99737 16.9997L2.49737 9.57169C2.00268 9.0903 1.61301 8.5117 1.35292 7.87232C1.09282 7.23295 0.967933 6.54664 0.986109 5.85662C1.00428 5.1666 1.16513 4.48782 1.45853 3.86303C1.75192 3.23823 2.17151 2.68094 2.69086 2.22627C3.21021 1.77159 3.81808 1.42938 4.47618 1.22117C5.13429 1.01296 5.82838 0.943272 6.51474 1.01649C7.2011 1.08971 7.86487 1.30425 8.46425 1.64659C9.06362 1.98894 9.58562 2.45169 9.99737 3.00569C10.4109 2.45571 10.9335 1.99701 11.5325 1.65829C12.1314 1.31958 12.7939 1.10814 13.4783 1.03721C14.1627 0.966279 14.8545 1.03739 15.5101 1.24608C16.1658 1.45477 16.7714 1.79656 17.2889 2.25005C17.8064 2.70354 18.2248 3.25897 18.5178 3.88158C18.8108 4.50419 18.9721 5.18057 18.9917 5.8684C19.0112 6.55622 18.8886 7.24068 18.6315 7.87894C18.3744 8.5172 17.9883 9.09551 17.4974 9.57769" stroke="#4D5462" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

  var orders_icon =
    '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 5.5L9 1L1 5.5M17 5.5V14.5L9 19M17 5.5L9 10M9 19L1 14.5V5.5M9 19V10M1 5.5L9 10" stroke="#4D5462" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

  var address_icon =
    '<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 15.5L7 14M7 14L1 17V4L7 1M7 14V1M7 1L13 4M13 4L19 1V8.5M13 4V9.5M17 15V15.01M19.121 17.1207C19.5407 16.7011 19.8265 16.1666 19.9423 15.5846C20.0581 15.0027 19.9988 14.3994 19.7717 13.8512C19.5447 13.303 19.1602 12.8344 18.6668 12.5047C18.1734 12.175 17.5934 11.999 17 11.999C16.4066 11.999 15.8266 12.175 15.3332 12.5047C14.8398 12.8344 14.4553 13.303 14.2283 13.8512C14.0012 14.3994 13.9419 15.0027 14.0577 15.5846C14.1735 16.1666 14.4594 16.7011 14.879 17.1207C15.297 17.5397 16.004 18.1657 17 18.9997C18.051 18.1097 18.759 17.4837 19.121 17.1207Z" stroke="#4D5462" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

  var logout_icon =
    '<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 5V3C8 2.46957 8.21071 1.96086 8.58579 1.58579C8.96086 1.21071 9.46957 1 10 1H17C17.5304 1 18.0391 1.21071 18.4142 1.58579C18.7893 1.96086 19 2.46957 19 3V15C19 15.5304 18.7893 16.0391 18.4142 16.4142C18.0391 16.7893 17.5304 17 17 17H10C9.46957 17 8.96086 16.7893 8.58579 16.4142C8.21071 16.0391 8 15.5304 8 15V13M13 9H1M1 9L4 6M1 9L4 12" stroke="#4D5462" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

  $(".woocommerce-MyAccount-navigation-link--edit-account a").prepend(
    edit_account_icon
  );
  $(".woocommerce-MyAccount-navigation-link--orders a").prepend(orders_icon);
  $(".woocommerce-MyAccount-navigation-link--wishlist a").prepend(
    wishlist_icon
  );
  $(".woocommerce-MyAccount-navigation-link--edit-address a").prepend(
    address_icon
  );
  $(".woocommerce-MyAccount-navigation-link--customer-logout a").prepend(
    logout_icon
  );

  $("#profile_picture").on("change", function (event) {
    var file = event.target.files[0]; // Get the file

    if (file) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(".profile-picture-preview img").attr("src", e.target.result).show(); // Set the src and show image
      };

      reader.readAsDataURL(file); // Read the file
    }
  });
})(jQuery);
