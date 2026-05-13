<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package highlt
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php 
    wp_body_open(); 

    do_action('highlt_after_body');
    
    $page_container_meta = Highlt_Group_Fields_Value::page_container('highlt', 'header_options');
    ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'highlt'); ?></a>
        <header id="masthead" class="site-header">
            <?php
            $job_single_meta_data = get_post_meta(get_the_ID(), 'highlt_job_options', true);
            $is_arabic = $job_single_meta_data['set_arabic'];
            $job_type = $job_single_meta_data['job_type'];
            $job_location = $job_single_meta_data['job_location'];
            $job_apply_btn_url = $job_single_meta_data['job_apply_btn_url'];

            $cats = get_the_terms(get_the_ID(), 'job_cat');
            if ($is_arabic) {
                get_template_part('template-parts/header/header', 'style-01');
            } else {
                get_template_part('template-parts/header/header', '');
            } ?>
        </header><!-- #masthead -->
        <?php do_action('highlt_before_page_content') ?>
        <div id="content" class="site-content">
            <?php
            $page_layout_meta = Highlt_Group_Fields_Value::page_layout_options('job_single');
            $full_width_class = $page_layout_meta['content_column_class'] === 'col-lg-12' ? ' full-width-content ' : '';
            ?>
            <div id="primary"
                class="content-area job-details-page <?php echo ($is_arabic ? 'arabic' : ''); ?> padding-bottom-120 padding-top-25 ">
                <main id="main" class="site-main">
                    <div class="container custom-container">
                        <div class="row">
                            <!-- Your Code -->
                        </div>
                    </div>
                </main><!-- #main -->
            </div><!-- #primary -->

        </div><!-- #content -->
        <?php
        if ($is_arabic) {
            get_template_part('template-parts/footer/footer', 'style-01');
        } else {
            get_template_part('template-parts/footer/footer', '');
        } ?>

    </div><!-- #page -->

    <?php wp_footer(); ?>

</body>

</html>