<?php

/**
 * Blog Single Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package highlt
 */

// Use the custom single-post hero below instead of the default breadcrumb bar.
if (class_exists('Highlt_Customize')) {
    remove_action('highlt_before_page_content', array(Highlt_Customize::getInstance(), 'breadcrumb'));
}

get_header();
$highlt = highlt();
if ($highlt->is_highlt_core_active()) {
    highlt_core()->setPostViews(get_the_ID());
}
?>
<div id="primary" class="content-area blog-single-page">
    <main id="main" class="site-main">
        <?php while (have_posts()) : the_post();
            $excerpt = get_the_excerpt();
        ?>

            <!-- Hero -->
            <section class="blog-single-hero">
                <div class="container">
                    <div class="blog-single-hero-inner">
                        <div class="blog-single-date">
                            <span><?php echo esc_html(get_the_date()); ?></span>
                        </div>
                        <h1 class="blog-single-title"><?php the_title(); ?></h1>
                        <?php if ($excerpt) : ?>
                            <p class="blog-single-excerpt"><?php echo esc_html($excerpt); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- Featured image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="blog-single-thumb">
                    <div class="container">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Content + Table of contents -->
            <div class="blog-single-body">
                <div class="container">
                    <div class="blog-single-layout">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-single-content-wrap'); ?>>
                            <div class="entry-content js-toc-content">
                                <?php
                                the_content();
                                $highlt->link_pages();
                                ?>
                            </div>
                        </article>

                        <aside class="blog-single-toc">
                            <div class="toc-widget js-toc">
                                <h2 class="toc-title"><?php esc_html_e('Table of Contents', 'highlt'); ?></h2>
                                <ul class="toc-list js-toc-list"></ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>

        <?php endwhile; // End of the loop. ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
