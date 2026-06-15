/**
 * Theme Main Scripts
 * @since 1.0.0
 */

// ScrollSmoother + sticky header init
if (typeof ScrollSmoother !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

  ScrollSmoother.create({
    wrapper: '#smooth-wrapper',
    content: '#smooth-content',
    smooth: 1.5,
    effects: true,
    smoothTouch: 0.1,
  });

  ScrollTrigger.create({
    start: 'top -80',
    onEnter: function () { document.getElementById('masthead').classList.add('header-sticky'); },
    onLeaveBack: function () { document.getElementById('masthead').classList.remove('header-sticky'); },
  });
}

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



  /**
   * Blog single — build the Table of Contents from <h2> headings,
   * smooth-scroll on click and highlight the active section.
   */
  $(function () {
    var $content = $('.js-toc-content');
    var $toc = $('.js-toc');

    if (!$content.length || !$toc.length) {
      return;
    }

    var $list = $toc.find('.js-toc-list');
    var $headings = $content.find('h2');
    var headerOffset = 120;

    // No headings -> hide the TOC and let the article go full width.
    if (!$headings.length) {
      $('.blog-single-toc').hide();
      $('.blog-single-layout').addClass('no-toc');
      return;
    }

    var items = [];

    $headings.each(function (i) {
      var $h = $(this);
      var id = $h.attr('id');

      if (!id) {
        id = 'toc-' + (i + 1) + '-' + $.trim($h.text()).toLowerCase()
          .replace(/[^a-z0-9]+/g, '-')
          .replace(/(^-+|-+$)/g, '');
        $h.attr('id', id);
      }

      $list.append(
        '<li class="toc-item"><a class="toc-link" href="#' + id +
        '" data-target="' + id + '">' + $h.text() + '</a></li>'
      );

      items.push({ id: id, el: this, offset: 0 });
    });

    var $links = $list.find('.toc-link');

    function computeOffsets() {
      items.forEach(function (it) {
        if (window.highltSmoother && typeof window.highltSmoother.offset === 'function') {
          it.offset = window.highltSmoother.offset(it.el, 'top ' + headerOffset + 'px');
        } else {
          it.offset = $(it.el).offset().top - headerOffset;
        }
      });
    }

    function currentScroll() {
      return window.highltSmoother && typeof window.highltSmoother.scrollTop === 'function'
        ? window.highltSmoother.scrollTop()
        : $(window).scrollTop();
    }

    function setActive() {
      var pos = currentScroll() + 10;
      var currentId = items[0].id;

      for (var i = 0; i < items.length; i++) {
        if (items[i].offset <= pos) {
          currentId = items[i].id;
        }
      }

      $links.removeClass('active');
      $list.find('.toc-link[data-target="' + currentId + '"]').addClass('active');
    }

    // Smooth scroll to the heading (uses ScrollSmoother when present).
    $list.on('click', '.toc-link', function (e) {
      e.preventDefault();
      var target = document.getElementById($(this).data('target'));
      if (!target) return;

      if (window.highltSmoother && typeof window.highltSmoother.scrollTo === 'function') {
        window.highltSmoother.scrollTo(target, true, 'top ' + headerOffset + 'px');
      } else {
        $('html, body').animate({ scrollTop: $(target).offset().top - headerOffset }, 600);
      }
    });

    computeOffsets();
    setActive();

    if (window.ScrollTrigger) {
      // Scrollspy across the whole page.
      ScrollTrigger.create({ start: 0, end: 'max', onUpdate: setActive });
      ScrollTrigger.addEventListener('refreshInit', computeOffsets);

      // Content height changes once images load -> recalc scroll range.
      ScrollTrigger.refresh();
    } else {
      $(window).on('scroll', setActive);
    }

    $(window).on('load resize', function () {
      computeOffsets();
      setActive();
      if (window.ScrollTrigger) {
        ScrollTrigger.refresh();
      }
    });
  });

  


    
})(jQuery);
