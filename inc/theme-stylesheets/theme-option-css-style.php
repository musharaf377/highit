<?php

/**
 * Theme Options Style
 * @package highit
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
$highit = highit();
global $theme_customize_css;
$theme_customize_css = '';

ob_start();

/*--------------------------------
    Typography
--------------------------------*/

/* body font */
$body_font = cs_get_option('_body_font') ? cs_get_option('_body_font') : false;
$body_font_variant = cs_get_option('body_font_variant') ? cs_get_option('body_font_variant') : false;
$body_font['family'] = (isset($body_font['font-family']) && !empty($body_font['font-family'])) ? $body_font['font-family'] : 'FFF Acid Grotesk';
$body_font['weight'] = (isset($body_font['font-weight']) && !empty($body_font['font-weight'])) ? $body_font['font-weight'] : '400';
$body_font['size'] = (isset($body_font['font-size']) && !empty($body_font['font-size'])) ? $body_font['font-size'] : '16px';

$typography_css = $highit->generate_css_code([
    'font-family' => $body_font['family'] . ', sans-serif'
], 'html,body');

$typography_css .= $highit->generate_css_code([
    'font-size' => $highit->sanitize_px($body_font['size']),
    'font-weight' => $body_font['weight']
], 'p,body');
$typography_css .= $highit->generate_css_code([
    '--body-font' => $body_font['family'] . ', sans-serif'
], ':root');

echo <<<CSS
{$typography_css}
CSS;

/* heading font */
$heading_font_enable = false;
if (null == cs_get_option('heading_font_enable')) {
    $heading_font_enable = false;
} elseif ('0' == cs_get_option('heading_font_enable')) {
    $heading_font_enable = true;
} elseif ('1' == cs_get_option('heading_font_enable')) {
    $heading_font_enable = false;
}
$heading_font = cs_get_option('heading_font') ? cs_get_option('heading_font') : false;
$heading_font_variant = cs_get_option('heading_font_variant') ? cs_get_option('heading_font_variant') : false;
$heading_font['family'] = (isset($heading_font['font-family']) && !empty($heading_font['font-family'])) ? $heading_font['font-family'] : 'PP Fragment';
$heading_font['weight'] = (isset($heading_font['font-weight']) && !empty($heading_font['font-weight'])) ? $heading_font['font-weight'] : '700';

$heading_font_css = $highit->generate_css_code([
    'font-family' => $heading_font['family'] . ', sans-serif',
    'font-weight' => $heading_font['weight']
], [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6'
]);

$heading_font_css .= $highit->generate_css_code([
    '--heading-font' => $heading_font['family'] . ', sans-serif'
], ':root');

$body_font_css = $highit->generate_css_code([
    '--heading-font' => $body_font['family'] . ', sans-serif'
], ':root');

if (!$heading_font_enable) {
    echo <<<CSS
  {$heading_font_css}
CSS;
} else {
    echo <<<CSS
    {$body_font_css}
CSS;
}


/*---------------------------------
	Main Color
---------------------------------*/
$main_color = cs_get_customize_option('main_color');
$main_color_two = cs_get_customize_option('main_color_two');
$secondary_color = cs_get_customize_option('secondary_color');
$heading_color = cs_get_customize_option('heading_color');
$paragraph_color = cs_get_customize_option('paragraph_color');

$root_color_css = $highit->generate_css_code([
    '--main-color-one' => $main_color,
    '--main-color-two' => $main_color_two,
    '--secondary-color' => $secondary_color,
    '--heading-color' => $heading_color,
    '--paragraph-color' => $paragraph_color
], ":root");

echo <<<CSS
{$root_color_css}
CSS;


/*---------------------------------
	Preloader
---------------------------------*/
$preloader_bg_color = cs_get_option('preloader_bg_color');
$preloader_css = $highit->generate_css_code([
    'background-color' => $preloader_bg_color
], '.preloader-inner');
echo <<<CSS
	{$preloader_css}
CSS;

/*---------------------------------
	Breadcrumb
---------------------------------*/
$breadcrumb_bg = cs_get_option('breadcrumb_bg');
$breadcrumb_bg_image = isset($breadcrumb_bg['background-image']['url']) && !empty($breadcrumb_bg['background-image']['url']) ? $breadcrumb_bg['background-image']['url'] : '';
$breadcrumb_bg_image_size = isset($breadcrumb_bg['background-size']) && !empty($breadcrumb_bg['background-size']) ? $breadcrumb_bg['background-size'] : 'cover';
$breadcrumb_bg_image_position = isset($breadcrumb_bg['background-position']) && !empty($breadcrumb_bg['background-position']) ? $breadcrumb_bg['background-position'] : 'center center';
$breadcrumb_bg_image_repeat = isset($breadcrumb_bg['background-repeat']) && !empty($breadcrumb_bg['background-repeat']) ? $breadcrumb_bg['background-repeat'] : 'no-repeat';
$breadcrumb_bg_image_attachment = isset($breadcrumb_bg['background-attachment']) && !empty($breadcrumb_bg['background-attachment']) ? $breadcrumb_bg['background-attachment'] : 'scroll';
$breadcrumb_bg_color = cs_get_option('breadcrumb_bg_color');

$breadcrumb_css = $highit->generate_css_code([

    'background-image' => 'url(' . $breadcrumb_bg_image . ')',
    'background-position' => $breadcrumb_bg_image_position,
    'background-repeat' => $breadcrumb_bg_image_repeat,
    'background-size' => $breadcrumb_bg_image_size,
    'background-attachment' => $breadcrumb_bg_image_attachment,

], '.breadcrumb-wrap');
$breadcrumb_css .= $highit->generate_css_code([
    'background-color' => $breadcrumb_bg_color,
], '.breadcrumb-wrap:before');

echo <<<CSS
{$breadcrumb_css}
CSS;

/*---------------------------------
	Footer Options
---------------------------------*/
$footer_spacing = cs_get_switcher_option('footer_spacing');
$footer_top_spacing = cs_get_option('footer_top_spacing');
$footer_bottom_spacing = cs_get_option('footer_bottom_spacing');
$footer_padding_top = !empty($footer_top_spacing) ? $highit->sanitize_px($footer_top_spacing) : '';
$footer_padding_bottom = !empty($footer_bottom_spacing) ? $highit->sanitize_px($footer_bottom_spacing) : '';


$footer_css = $highit->generate_css_code([
    'padding-top' => $footer_padding_top,
    'padding-bottom' => $footer_padding_bottom
], '.footer-style .footer-wrap .footer-top');

if ($footer_spacing) {
    echo <<<CSS
    {$footer_css}
CSS;
}

/*---------------------------------
	Copyright Area Options
---------------------------------*/
$copyright_area_spacing = cs_get_switcher_option('copyright_area_spacing');
$copyright_area_top_spacing = cs_get_option('copyright_area_top_spacing');
$copyright_area_bottom_spacing = cs_get_option('copyright_area_bottom_spacing');
$copyright_padding_top = !empty($copyright_area_top_spacing) ? $highit->sanitize_px($copyright_area_top_spacing) : '';
$copyright_padding_bottom = !empty($copyright_area_bottom_spacing) ? $highit->sanitize_px($copyright_area_bottom_spacing) : '';

$copyright_css = $highit->generate_css_code([
    'padding-top' => $copyright_padding_top,
    'padding-bottom' => $copyright_padding_bottom
], '.footer-wrap .copyright-wrap');

if ($copyright_area_spacing) {
    echo <<<CSS
	{$copyright_css}
CSS;
}

/*---------------------------------
	Header One
---------------------------------*/
$header_01_nav_bar_bg_color = cs_get_customize_option('header_01_nav_bar_bg_color');
$header_01_nav_bar_color = cs_get_customize_option('header_01_nav_bar_color');
$header_01_dropdown_bg_color = cs_get_customize_option('header_01_dropdown_bg_color');
$header_01_dropdown_color = cs_get_customize_option('header_01_dropdown_color');
$header_01_nav_bar_hover_color = cs_get_customize_option('header_01_nav_bar_hover_color');
$header_01_dropdown_border_color = cs_get_customize_option('header_01_dropdown_border_color');
$header_01_dropdown_hover_bg_color = cs_get_customize_option('header_01_dropdown_hover_bg_color');
$header_01_dropdown_hover_color = cs_get_customize_option('header_01_dropdown_hover_color');

$header_one_css = $highit->generate_css_code([
    'color' => $header_01_nav_bar_color
], [
    '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li a',
    '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li.menu-item-has-children:before'
]);

$header_one_css .= $highit->generate_css_code([
    'color' => $header_01_nav_bar_hover_color
], [
    '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li a:hover',
    '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li:hover a',
    '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li:hover.menu-item-has-children:before'
]);

$header_one_css .= $highit->generate_css_code([
    'background-color' => $header_01_nav_bar_bg_color
], '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default,.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container');

$header_one_css .= $highit->generate_css_code([
    'background-color' => $header_01_dropdown_bg_color,
    'color' => $header_01_dropdown_color,
], '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a');

$header_one_css .= $highit->generate_css_code([
    'background-color' => $header_01_dropdown_hover_bg_color,
    'color' => $header_01_dropdown_hover_color,
], '.navbar.navbar-area.navbar-expand-lg.navigation-style-01.navbar-default .custom-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li:hover a');

$header_one_css .= $highit->generate_css_code(
    [
        'color' => $header_01_nav_bar_hover_color,
    ],
    [
        '.navbar-area.navbar-default .custom-container .navbar-collapse .navbar-nav li a:hover',
        '.navbar-area.navbar-default .custom-container .navbar-collapse .navbar-nav li:hover a',
        '.navbar-area.navbar-default .custom-container .navbar-collapse .navbar-nav li:hover.menu-item-has-children:before'
    ]
);

$header_one_css .= $highit->generate_css_code([
    'border-bottom-color' => $header_01_dropdown_border_color,
], '.navbar-area.navbar-default .custom-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu');

echo <<<CSS
{$header_one_css}
CSS;

/*---------------------------------
	Sidebar
---------------------------------*/

$widget_border_color = cs_get_customize_option('sidebar_widget_border_color');
$widget_title_color = cs_get_customize_option('sidebar_widget_title_color');
$widget_text_color = cs_get_customize_option('sidebar_widget_text_color');
$sidebar_widget_title_bottom_border_color = cs_get_customize_option('sidebar_widget_title_bottom_border_color');

$sidebar_css = $highit->generate_css_code([
    'color' => $widget_title_color,
], [
    '.widget .widget-headline.style-01',
    '.widget_rss ul li a.rsswidget'
]);

$sidebar_css .= $highit->generate_css_code([
    'background-color' => $sidebar_widget_title_bottom_border_color
], [
    '.widget .widget-headline:after'
]);

$sidebar_css .= $highit->generate_css_code([
    'color' => $widget_text_color
], [
    '.widget ul li a',
    '.widget ul li',
    '.widget p',
    '.widget .table td',
    '.widget .table th',
    '.widget caption',
    '.widget .wp-calendar-nav-prev a',
    '.widget_tag_cloud .tagcloud a',
    '.calendar_wrap table td,.calendar_wrap table tr',
    '.widget_categories ul li a:before'
]);

echo <<<CSS
{$sidebar_css}
CSS;
/*-----------------------------------
	Footer Options
-----------------------------------*/
$footer_area_bg_color = cs_get_customize_option('footer_area_bg_color');
$footer_area_bottom_border_color = cs_get_customize_option('footer_area_bottom_border_color');
$footer_widget_title_color = cs_get_customize_option('footer_widget_title_color');
$footer_widget_text_color = cs_get_customize_option('footer_widget_text_color');
$footer_widget_text_hover_color = cs_get_customize_option('footer_widget_text_hover_color');
$footer_widget_tag_color = cs_get_customize_option('footer_widget_tag_color');
$footer_widget_tag_bg_color = cs_get_customize_option('footer_widget_tag_bg_color');
$footer_widget_tag_border_color = cs_get_customize_option('footer_widget_tag_border_color');
$copyright_area_bg_color = cs_get_customize_option('copyright_area_bg_color');
$copyright_area_text_color = cs_get_customize_option('copyright_area_text_color');

$footer_css = $highit->generate_css_code([
    'background-color' => $footer_area_bg_color
], ['.footer-style .footer-wrap']);

$footer_css .= $highit->generate_css_code([
    'border-bottom-color' => $footer_area_bottom_border_color
], ['.footer-style .footer-wrap .footer-top']);

$footer_css .= $highit->generate_css_code([
    'color' => $footer_widget_text_color
], [
    '.widget.footer-widget p',
    '.widget.footer-widget.widget_calendar caption',
    '.widget.footer-widget.widget_calendar th',
    '.widget.footer-widget.widget_calendar td',
    '.footer-widget.widget p',
    '.footer-widget.widget a',
    '.footer-widget.widget',
    '.widget.footer-widget ul li a',
    '.widget.footer-widget ul li',
    '.widget_tag_cloud.footer-widget .tagcloud a'
]);

$footer_css .= $highit->generate_css_code([
    'color' => $footer_widget_text_hover_color
], [
    '.footer-widget.widget a:hover',
    '.widget.footer-widget ul li a:hover',
    '.widget_tag_cloud.footer-widget .tagcloud a:hover'
]);

$footer_css .= $highit->generate_css_code([
    'color' => $footer_widget_title_color
], [
    '.widget.footer-widget .widget-headline',
    '.widget.footer-widget .widget-headline a',
    'footer-widget.widget_rss ul li a.rsswidget',
    '.footer-widget.widget .theme-recent-post-wrap li.theme-recent-post-item .content .title>a'
]);

$footer_css .= $highit->generate_css_code([
    'color' => $footer_widget_tag_color,
    'background-color' => $footer_widget_tag_bg_color,
    'border-color' => $footer_widget_tag_border_color
], ['.footer-widget.widget_tag_cloud .tagcloud a:hover']);

$copyright_css = $highit->generate_css_code([
    'background-color' => $copyright_area_bg_color
], '.footer-style .footer-wrap .copyright-wrap');

$copyright_css .= $highit->generate_css_code([
    'color' => $copyright_area_text_color
], '.footer-style .copyright-wrap .copyright-content');

echo <<<CSS
{$footer_css}
CSS;
/* Copyright Area
 * */
echo <<<CSS
{$copyright_css}
CSS;

/*---------------------------------
	404 Error Page Options
---------------------------------*/
$error_page_bg_color = cs_get_option('404_bg_color');
$err_404_spacing_top = cs_get_option('404_spacing_top');
$err_404_spacing_bottom = cs_get_option('404_spacing_bottom');
$err_padding_top = !empty($err_404_spacing_top) ? $highit->sanitize_px($err_404_spacing_top) : '';
$err_padding_bottom = !empty($err_404_spacing_bottom) ? $highit->sanitize_px($err_404_spacing_bottom) : '';

$error_css = $highit->generate_css_code([
    'background-color' => $error_page_bg_color,
    'padding-top' => $err_padding_top,
    'padding-bottom' => $err_padding_bottom
], '.error_page_content_area');

echo <<<CSS
  {$error_css}
CSS;
/*---------------------------------
	Blog Page Options
---------------------------------*/
$blog_page_bg_color = cs_get_option('blog_bg_color');
$blog_page_spacing_top = cs_get_option('blog_spacing_top');
$blog_page_spacing_bottom = cs_get_option('blog_spacing_bottom');
$blog_padding_top = !empty($blog_page_spacing_top) ? $highit->sanitize_px($blog_page_spacing_top) : '';
$blog_padding_bottom = !empty($blog_page_spacing_bottom) ? $highit->sanitize_px($blog_page_spacing_bottom) : '';

$blog_css = $highit->generate_css_code([
    'background-color' => $blog_page_bg_color,
    'padding-top' => $blog_padding_top,
    'padding-bottom' => $blog_padding_bottom
], '.blog-page-content-area');

echo <<<CSS
  {$blog_css}
CSS;
/*---------------------------------
	Blog Single Page Options
---------------------------------*/
$blog_single_page_bg_color = cs_get_option('blog_single_bg_color');
$blog_single_page_spacing_top = cs_get_option('blog_single_spacing_top');
$blog_single_page_spacing_bottom = cs_get_option('blog_single_spacing_bottom');
$blog_single_padding_top = !empty($blog_single_page_spacing_top) ? $highit->sanitize_px($blog_single_page_spacing_top) : '';
$blog_single_padding_bottom = !empty($blog_single_page_spacing_bottom) ? $highit->sanitize_px($blog_single_page_spacing_bottom) : '';

$blog_single_css = $highit->generate_css_code([
    'background-color' => $blog_single_page_bg_color,
    'padding-top' => $blog_single_padding_top,
    'padding-bottom' => $blog_single_padding_bottom
], '.blog-content-page');

echo <<<CSS
  {$blog_single_css}
CSS;


/*---------------------------------
	Archive Page Options
---------------------------------*/
$archive_page_bg_color = cs_get_option('archive_bg_color');
$archive_page_spacing_top = cs_get_option('archive_spacing_top');
$archive_page_spacing_bottom = cs_get_option('archive_spacing_bottom');
$archive_single_padding_top = !empty($archive_page_spacing_top) ? $highit->sanitize_px($archive_page_spacing_top) : '';
$archive_single_padding_bottom = !empty($archive_page_spacing_bottom) ? $highit->sanitize_px($archive_page_spacing_bottom) : '';

$archive_page_css = $highit->generate_css_code([
    'background-color' => $archive_page_bg_color,
    'padding-top' => $archive_single_padding_top,
    'padding-bottom' => $archive_single_padding_bottom
], '.archive-page-content-area');

echo <<<CSS
  {$archive_page_css}
CSS;

/*---------------------------------
	Search Page Options
---------------------------------*/
$search_page_bg_color = cs_get_option('search_bg_color');
$search_page_spacing_top = cs_get_option('search_spacing_top');
$search_page_spacing_bottom = cs_get_option('search_spacing_bottom');
$search_single_padding_top = !empty($search_page_spacing_top) ? $highit->sanitize_px($search_page_spacing_top) : '';
$search_single_padding_bottom = !empty($search_page_spacing_bottom) ? $highit->sanitize_px($search_page_spacing_bottom) : '';

$search_page_css = $highit->generate_css_code([
    'background-color' => $search_page_bg_color,
    'padding-top' => $search_single_padding_top,
    'padding-bottom' => $search_single_padding_bottom
], '.search-page-content-area');

echo <<<CSS
  {$search_page_css}
CSS;

/*---------------------------------
	Service Single Page Options
---------------------------------*/
$service_single_page_bg_color = cs_get_option('service_single_bg_color');
$service_single_page_spacing_top = cs_get_option('service_single_spacing_top');
$service_single_page_spacing_bottom = cs_get_option('service_single_spacing_bottom');
$search_single_padding_top = !empty($service_single_page_spacing_top) ? $highit->sanitize_px($service_single_page_spacing_top) : '';
$search_single_padding_bottom = !empty($service_single_page_spacing_bottom) ? $highit->sanitize_px($service_single_page_spacing_bottom) : '';

$service_single_page_css = $highit->generate_css_code([
    'background-color' => $service_single_page_bg_color,
    'padding-top' => $search_single_padding_top,
    'padding-bottom' => $search_single_padding_bottom
], '.service-details-page');

echo <<<CSS
  {$service_single_page_css}
CSS;


$theme_customize_css = ob_get_clean();
