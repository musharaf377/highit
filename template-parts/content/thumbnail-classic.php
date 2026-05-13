<?php

/**
 * Post Thumbnail Functions
 * @package highlt
 * @since 1.0.0
 */

$highlt = highlt();
if (has_post_thumbnail()): ?>
    <div class="thumbnail">
        <?php $highlt->post_thumbnail('post-thumbnail'); ?>
    </div>
<?php endif; ?>