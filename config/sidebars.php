<?php

return array(
    array(
        'name' => esc_html__('Sidebar', 'highit'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'highit'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-headline style-01">',
        'after_title' => '</h4>',
    ),
    array(
        'name' => esc_html__('Products Sidebar', 'highit'),
        'id' => 'product-sidebar',
        'description' => esc_html__('Add widgets here.', 'highit'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-headline style-01">',
        'after_title' => '</h4>',
    ),
    array(
        'name' => esc_html__('Footer Widget Area', 'highit'),
        'id' => 'footer-widget',
        'description' => esc_html__('Add widgets here.', 'highit'),
        'before_widget' => '<div class="col-lg-3 col-md-6"><div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-headline">',
        'after_title' => '</h4>',
    )
);
