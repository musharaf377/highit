<?php

/**
 * Theme Default Header
 * @package highlt
 * @since 1.0.0
 */
?>


<nav class="navbar navbar-area navbar-expand-lg">
    <div class="container custom-container">
        <div class="header-wrapper">
            <div class="logo-wrapper">
                <?php
                $header_one_logo = cs_get_option('header_one_logo');
                if (has_custom_logo() && empty($header_one_logo['id'])) {
                    the_custom_logo();
                } elseif (! empty($header_one_logo['id'])) {
                    printf('<a class="site-logo" href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $header_one_logo['url'], $header_one_logo['alt']);
                } else {
                    printf('<a class="site-title" href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                }
                ?>
            </div>

            <div id="highlt_main_menu" class="collapse navbar-collapse">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class'     => 'navbar-nav',
                    'container'      => false,
                ));
                ?>
            </div>

            <div class="header-btn">
                <div class="contact-btn-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <a class="contact-btn" href="<?php echo esc_url(cs_get_option('header_button_url', '#')); ?>">
                        <p><?php echo esc_html(cs_get_option('header_button_text', __('Contact Us', 'highlt'))); ?></p>
                        <?php echo highlt_get_svg_icon('right_arrow'); ?>
                    </a>    
                </div>
            </div>

            <button class="mobile-navbar-toggler">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</nav>