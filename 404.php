<?php

/**
 * The template for displaying 404 Error page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package highlt
 */

get_header();
$get_404_options_value = Highlt_Group_Fields_Value::get_404_options_value();
$error_bg = cs_get_option('error_bg');
?>

<div id="primary" class="content-area error-404-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="error-404 not-found">
                <div class="error-404-code" aria-hidden="true">
                    <span>4</span>
                    <span class="error-404-zero">0</span>
                    <span>4</span>
                </div>
               
                <p class="paragraph"><?php echo esc_html($get_404_options_value['paragraph']); ?></p>
                <div class="error-404-btn-wrap">
                    <div class="contact-btn-wrap">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <a class="contact-btn"
                            href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($get_404_options_value['btn_text']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
