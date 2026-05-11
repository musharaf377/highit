<?php

/**
 * Post Thumbnail Functions
 * @package highit
 * @since 1.0.0
 */

$highit = highit();
if (has_post_thumbnail()): ?>
    <div class="thumbnail">
        <?php $highit->post_thumbnail('post-thumbnail'); ?>
    </div>
<?php endif; ?>