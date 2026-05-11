<?php

/**
 * Post Thumbnail Video
 * @package highit
 * @since 1.0.0
 */

$highit = highit();
$post_meta = get_post_meta(get_the_ID(), 'highit_post_video_options', true);
$video_url = isset($post_meta['video_url']) && $post_meta['video_url'] ? $post_meta['video_url'] : '';
$blog_single_options = Highit_Group_Fields_Value::post_meta('blog_single_post');
if (!empty($video_url)):
?>
    <div class="thumbnail">
        <?php $highit->post_thumbnail('post-thumbnail'); ?>
        <?php if (!empty($video_url)): ?>
            <div class="hover">
                <a href="<?php echo esc_url($video_url); ?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>