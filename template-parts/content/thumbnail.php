<?php

/**
 * Post Thumbnail 
 * @package highlt
 * @since 1.0.0
 */
?>

<div class="thumbnail">
    <?php
    if (has_post_thumbnail() && get_post_type() == 'post') {
        highlt()->post_thumbnail('post-thumbnail');
    }
    ?>
</div>