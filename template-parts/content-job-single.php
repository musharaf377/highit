<?php

/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package highlt
 */
$highlt = Highlt();
$post_single_meta = Highlt_Group_Fields_Value::post_meta('job_single_post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-details-item'); ?>>
    <div class="entry-content">
        <?php
        echo '<h1 class="title">' . get_the_title(get_the_ID()) . '</h1>';
        the_content();
        $highlt->link_pages();
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->