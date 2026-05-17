<?php

/**
 * Theme Metabox Options
 * @package highlt
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}

if (class_exists('CSF')) {

    $allowed_html = highlt()->kses_allowed_html(array('mark'));

    $prefix = 'highlt';

    /*-------------------------------------
        Post Format Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_post_video_options', array(
        'title' => esc_html__('Video Post Format Options', 'highlt'),
        'post_type' => 'post',
        'post_formats' => 'video'
    ));
    CSF::createSection($prefix . '_post_video_options', array(
        'fields' => array(
            array(
                'id' => 'video_url',
                'type' => 'text',
                'title' => esc_html__('Enter Video URL', 'highlt'),
                'desc' => wp_kses(__('enter <mark>video url</mark> to show in frontend', 'highlt'), $allowed_html)
            )
        )
    ));
    CSF::createMetabox($prefix . '_post_gallery_options', array(
        'title' => esc_html__('Gallery Post Format Options', 'highlt'),
        'post_type' => 'post',
        'post_formats' => 'gallery'
    ));
    CSF::createSection($prefix . '_post_gallery_options', array(
        'fields' => array(
            array(
                'id' => 'gallery_images',
                'type' => 'gallery',
                'title' => esc_html__('Select Gallery Photos', 'highlt'),
                'desc' => wp_kses(__('select <mark>gallery photos</mark> to show in frontend', 'highlt'), $allowed_html)
            )
        )
    ));

    /*-------------------------------------
      Page Container Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_page_container_options', array(
        'title' => esc_html__('Page Options', 'highlt'),
        'post_type' => array('page'),
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Layout & Colors', 'highlt'),
        'icon' => 'fa fa-columns',
        'fields' => Highlt_Group_Fields::page_layout()
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Header Footer & Breadcrumb', 'highlt'),
        'icon' => 'fa fa-header',
        'fields' => Highlt_Group_Fields::Page_Container_Options('header_options')
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Width & Padding', 'highlt'),
        'icon' => 'fa fa-file-o',
        'fields' => Highlt_Group_Fields::Page_Container_Options('container_options')
    ));

    //  Portfolio Meta Box
    CSF::createMetabox($prefix . '_portfolio_options', array(
        'title' => esc_html__('Portfolio Options', 'highlt'),
        'post_type' => 'portfolio',
    ));

    CSF::createSection($prefix . '_portfolio_options', array(
        'title' => esc_html__('Portfolio Media Options', 'highlt'),
        'fields' => array(
            array(
                'id' => 'option_video',
                'type' => 'checkbox',
                'title' => esc_html__('Video', 'highlt'),
                'options' => array(
                    'video' => esc_html__('Video', 'highlt'),
                ),
            ),
            array(
                'id' => 'portfolio_video_title',
                'type' => 'text',
                'title' => esc_html__('Video Title', 'highlt'),
                'desc' => wp_kses(__('enter <mark>video title</mark> to show in frontend', 'highlt'), $allowed_html),
                'dependency' => array('option_video', '==', '1'),
            ),
            array(
                'id' => 'portfolio_video_url',
                'type' => 'text',
                'title' => esc_html__('Video URL', 'highlt'),
                'desc' => wp_kses(__('enter <mark>video url</mark> to show in frontend', 'highlt'), $allowed_html),
                'dependency' => array('option_video', '==', '1'),
            ),
            array(
                'id' => 'option_image',
                'type' => 'checkbox',
                'title' => esc_html__('Image', 'highlt'),
                'options' => array(
                    'image' => esc_html__('Image', 'highlt'),
                ),
            ),
        ),
    ));
}
//endif

