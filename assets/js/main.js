/**
 * Theme Main Scripts
 * @since 1.0.0
 */
(function ($) {
  "use strict";

  jQuery(document).ready(function ($) {
  
    /*-------------------------------
            back to top
        ------------------------------*/
    $(document).on("click", ".back-to-top", function () {
      $("html,body").animate(
        {
          scrollTop: 0,
        },
        2000
      );
    });
  });

  $(window).on("resize", function () {});

  

  $(window).on("load", function () {
    /*-----------------------------
            preloader
    -----------------------------*/
    var preLoder = $("#preloader");
    preLoder.fadeOut(1000);
  });


  /**
     * Mobile menu click function
     */
    $(document).on("click", ".navbar-toggler", function () {
      $(this).toggleClass("active");
      $("#homiberia_main_menu").collapse("toggle");

      // Close menu when a nav link is clicked
      $('#homiberia_main_menu .nav-link').on('click', function () {
        $('#homiberia_main_menu').collapse('hide');
        $('.navbar-toggler').removeClass('active');
      });

      // Ensure the navbar collapses when clicking outside
      $(document).on('click.homiberiaCollapse', function (e) {
        if (!$(e.target).closest('#homiberia_main_menu').length &&
          !$(e.target).closest('.navbar-toggler').length) {
          $("#homiberia_main_menu").collapse('hide');
          $('.navbar-toggler').removeClass('active');
          $(document).off('click.homiberiaCollapse');
        }
      });
    });



  


    
})(jQuery);
