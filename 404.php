<?php

/**
 * The template for displaying 404 Error page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package highit
 */

get_header();
$get_404_options_value = Highit_Group_Fields_Value::get_404_options_value();
$error_bg = cs_get_option('error_bg');
?>

<div id="primary" class="content-area error_page_content_area padding-top-110 padding-bottom-110">
    <main id="main" class="site-main">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="error-404 not-found">
                        <?php if (!empty($error_bg)): ?>
                            <div class="thumb">
                                <img src="<?php echo esc_url($error_bg['url']) ?>"
                                    alt="<?php echo esc_attr($error_bg['alt']) ?>">
                            </div>
                        <?php endif; ?>
                        <h2 class="title"><?php echo esc_html($get_404_options_value['title']); ?></h2>
                        <p class="paragraph"><?php echo esc_html($get_404_options_value['paragraph']); ?></p>
                        <?php
                        get_search_form();
                        ?>
                        <div class="btn-wrap desktop-center margin-top-30">
                            <a class="boxed-btn"
                                href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($get_404_options_value['btn_text']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
