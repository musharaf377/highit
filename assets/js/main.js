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
   * Mobile menu toggle
   */
  $(document).on("click", ".mobile-navbar-toggler", function () {
    $(this).toggleClass("active");
    $("#highlt_main_menu").toggleClass("show");

    $(document).on('click.highltCollapse', function (e) {
      if (!$(e.target).closest('#highlt_main_menu').length &&
        !$(e.target).closest('.mobile-navbar-toggler').length) {
        $("#highlt_main_menu").removeClass("show");
        $('.mobile-navbar-toggler').removeClass('active');
        $(document).off('click.highltCollapse');
      }
    });
  });

  // Close menu when a leaf nav-link is clicked (not a parent toggle)
  $(document).on('click', '#highlt_main_menu .nav-link', function () {
    if (!$(this).closest('.menu-item-has-children').length) {
      $("#highlt_main_menu").removeClass("show");
      $('.mobile-navbar-toggler').removeClass('active');
    }
  });

  /**
   * Mobile dropdown expand on click
   */
  $(document).on('click', '#highlt_main_menu .menu-item-has-children > a', function (e) {
    if ($(window).width() <= 1199) {
      e.preventDefault();
      var $parent = $(this).parent();
      $parent.siblings('.menu-item-has-children').removeClass('menu-open')
        .find('> .sub-menu').slideUp(250);
      $parent.toggleClass('menu-open');
      $parent.find('> .sub-menu').slideToggle(250);
    }
  });



  


    
})(jQuery);
