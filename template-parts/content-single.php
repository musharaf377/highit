<?php

/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package highlt
 */

$highlt = highlt();
$post_meta = get_post_meta(get_the_ID(), 'highlt_post_gallery_options', true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$post_single_meta = Highlt_Group_Fields_Value::post_meta('blog_single_post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-single-content-wrap'); ?>>

    <div class="entry-content">
        <?php
        
        the_content();
        $highlt->link_pages();
        ?>
    </div>

</article>
<!-- #post-<?php //the_ID(); ?> -->