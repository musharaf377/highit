<?php

/**
 * Theme Default Header
 * @package highit
 * @since 1.0.0
 */
?>


<nav class="navbar navbar-area navbar-expand-lg">
    <div class="container custom-container">
        <div class="header-wrapper">
            <div class="responsive-mobile-menu">
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#highit_main_menu"
                    aria-expanded="false" aria-label="<?php  //esc_attr__('Toggle navigation', 'highit') 
                                                        ?>">
                    <span class="navbar-toggler-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="#0E0E0F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </div>

            <div id="highit_main_menu" class="collapse navbar-collapse">
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
                    <a class="contact-btn" href="#">
                        <p>Contact Us</p>
                        <?php echo highit_get_svg_icon('right_arrow'); ?>
                    </a>    
                </div>
            </div>
        </div>
    </div>
</nav>