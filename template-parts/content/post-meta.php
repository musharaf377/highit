<?php

/**
 * Post Meta Functions
 * @package highit
 * @since 1.0.0
 */

$highit = highit();
$post_meta = Highit_Group_Fields_Value::post_meta('blog_post');
?>
<div class="post-meta-wrap">
    <ul class="post-meta">
        <?php if ($post_meta['posted_by']): ?>
            <li><?php $highit->posted_by(); ?></li>
        <?php endif; ?>
        <li>
            <?php
            $highit->posted_on();
            ?>
        </li>
        <li>
            <?php
            $highit->comment_count();
            ?>
        </li>
    </ul>
    <?php

    if (shortcode_exists('highit_post_share') && $post_meta['posted_share']) {
        echo do_shortcode('[highit_post_share]');
    }
    ?>
</div>