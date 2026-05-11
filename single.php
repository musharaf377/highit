<?php

/**
 * Blog Single Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package highit
 */

get_header();
$highit = highit();
$page_layout_meta = Highit_Group_Fields_Value::page_layout_options('blog_single');
$full_width_class = $page_layout_meta['content_column_class'] === 'col-lg-12' ? ' full-width-content ' : '';
if ($highit->is_highit_core_active()) {
    highit_core()->setPostViews(get_the_ID());
}
?>
<div id="primary" class="content-area blog-content-page padding-bottom-120 padding-top-25 <?php echo esc_attr($full_width_class); ?>">
    <main id="main" class="site-main">
        <?php
        if (has_post_thumbnail() || !empty($post_meta_gallery)):
            $get_post_format = get_post_format();
            if ('video' == $get_post_format || 'gallery' == $get_post_format) {
                get_template_part('template-parts/content/thumbnail', $get_post_format);
            } else {
                get_template_part('template-parts/content/thumbnail');
            }
        endif;
        ?>


        <div class="blog-content-wrapper">
            <div class="container custom-container">
                <div class="row">
                    <div class="<?php echo esc_attr($page_layout_meta['content_column_class']); ?>">
                        <?php
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content', 'single');
                        endwhile; // End of the loop.
                        ?>
                    </div>
                    <?php if ($page_layout_meta['sidebar_enable']): ?>
                        <div class="<?php echo esc_attr($page_layout_meta['sidebar_column_class']); ?>">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
