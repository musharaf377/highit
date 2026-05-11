<?php

/**
 * Post Thumbnail 
 * @package highit
 * @since 1.0.0
 */
?>

<div class="thumbnail">
    <?php
    if (has_post_thumbnail() && get_post_type() == 'post') {
        highit()->post_thumbnail('post-thumbnail');
    }
    ?>
</div>