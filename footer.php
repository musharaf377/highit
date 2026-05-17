<?php

/**
 * Theme Footer Template
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package highlt
 */

$page_container_meta = Highlt_Group_Fields_Value::page_container('highlt', 'header_options');
?>

</div><!-- #content -->

<?php get_template_part('template-parts/footer/footer', $page_container_meta['footer_type']); ?>

</div><!-- #page -->

    </div><!-- #smooth-content -->
    </div><!-- #smooth-wrapper -->

<?php wp_footer(); ?>
</body>

</html>