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
    //	Service Meta Box
    CSF::createMetabox($prefix . '_team_options', array(
        'title' => esc_html__('Team Options', 'highlt'),
        'post_type' => 'team',
    ));
    CSF::createSection($prefix . '_team_options', array(
        'fields' => array(
            array(
                'id' => 'team_member_designation',
                'type' => 'text',
                'title' => esc_html__('Enter Team Member Designation', 'highlt'),
                'desc' => wp_kses(__('use <mark>{br}</mark> for break your designation', 'highlt'), $allowed_html),
                'default' => esc_html__('Managing Partner', 'highlt'),
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Team Member Social Link', 'highlt') . '</h3>'
            ),
            array(
                'id' => 'team_member_social_repeater',
                'type' => 'repeater',
                'title' => esc_html__('Team Member Social Repeater', 'highlt'),
                'fields' => array(
                    array(
                        'id' => 'team_member_social_image',
                        'type' => 'media',
                        'title' => esc_html__('Team Member Social Image', 'highlt'),
                    ),
                    array(
                        'id' => 'team_member_social_url',
                        'type' => 'text',
                        'title' => esc_html__('Social Link URL', 'highlt'),
                        'default' => '#'
                    ),
                )
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Team Member Contact List', 'highlt') . '</h3>'
            ),
            array(
                'id' => 'team_member_contact_repeater',
                'type' => 'repeater',
                'title' => esc_html__('Team Member Contact Repeater', 'highlt'),
                'fields' => array(
                    array(
                        'id' => 'team_member_contact_image',
                        'type' => 'media',
                        'title' => esc_html__('Team Member Contact Image', 'highlt'),
                    ),
                    array(
                        'id' => 'team_member_contact_text',
                        'type' => 'text',
                        'title' => esc_html__('Contact Info Text', 'highlt'),
                        'default' => '#'
                    ),
                )
            ),
        )
    ));
}//endif