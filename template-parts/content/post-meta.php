<?php

/**
 * Post Meta Functions
 * @package highlt
 * @since 1.0.0
 */

$highlt = highlt();
$post_meta = Highlt_Group_Fields_Value::post_meta('blog_post');
?>
<div class="post-meta-wrap">
    <ul class="post-meta">
        <?php if ($post_meta['posted_by']): ?>
            <li><?php $highlt->posted_by(); ?></li>
        <?php endif; ?>
        <li>
            <?php
            $highlt->posted_on();
            ?>
        </li>
        <li>
            <?php
            $highlt->comment_count();
            ?>
        </li>
    </ul>
    <?php

    if (shortcode_exists('highlt_post_share') && $post_meta['posted_share']) {
        echo do_shortcode('[highlt_post_share]');
    }
    ?>
</div>