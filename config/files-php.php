<?php

$php_files = array(
    array(
        'file-name' => 'activation',
        'file-path' => HIGHIT_TGMA
    ),
    array(
        'file-name' => 'singletone',
        'file-path' => HIGHIT_INC .  '/traits/'
    ),
    array(
        'file-name' => 'functions',
        'file-path' => HIGHIT_INC .  '/traits/'
    ),
    array(
        'file-name' => 'theme-breadcrumb',
        'file-path' => HIGHIT_INC
    ),
    array(
        'file-name' => 'theme-excerpt',
        'file-path' => HIGHIT_INC
    ),
    array(
        'file-name' => 'theme-hook-customize',
        'file-path' => HIGHIT_INC
    ),
    array(
        'file-name' => 'theme-comments-modifications',
        'file-path' => HIGHIT_INC
    ),
    array(
        'file-name' => 'customizer',
        'file-path' => HIGHIT_INC
    ),
    array(
        'file-name' => 'svg-icon',
        'file-path' => HIGHIT_INC . '/svg-icon/',
    ),

    array(
        'file-name' => 'theme-group-fields-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-group-fields-value-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-metabox-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-userprofile-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-shortcode-option-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-customizer-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
    array(
        'file-name' => 'theme-option-cs',
        'file-path' => HIGHIT_THEME_SETTINGS
    ),
);

if (class_exists('WooCommerce')) {
    $php_files[] = array(
        'file-name' => 'theme-woocommerce-customize',
        'file-path' => HIGHIT_INC
    );
}

return $php_files;
