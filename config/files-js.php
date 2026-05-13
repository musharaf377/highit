<?php

$js_files = array(
    array(
        'handle' => 'bootstrap',
        'src' => HIGHLT_JS . '/bootstrap.min.js',
        'deps' => array('jquery'),
        'in_footer' => true // This ensures the script is loaded in the footer
    ),
    array(
        'handle' => 'preloader',
        'src' => HIGHLT_JS . '/preloader.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
    array(
        'handle' => 'highlt-jquery-ui',
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
    array(
        'handle' => 'highlt-main-script',
        'src' => HIGHLT_JS . '/main' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    ),
);

if (class_exists('WooCommerce')) {
    $js_files[] = array(
        'handle' => 'highlt-woocommerce',
        'src' => HIGHLT_JS . '/woocommerce' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    );
    $js_files[] = array(
        'handle' => 'highlt-product-filter',
        'src' => HIGHLT_JS . '/product-filter' . $js_ext,
        'deps' => array('jquery'),
        'in_footer' => true
    );
}

return $js_files;
