<?php

$css_files = array(
    array(
        'handle' => 'bootstrap',
        'src' => HIGHLT_CSS . '/bootstrap.min.css',
        'deps' => array(),
    ),
    array(
        'handle' => 'jquery-ui',
        'src' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css',
        'deps' => array('bootstrap'),
    ),
    array(
        'handle' => 'highlt-main-style',
        'src' => HIGHLT_CSS . '/main-style' . $css_ext,
        'deps' => array(),
    ),
    array(
        'handle' => 'highlt-responsive',
        'src' => HIGHLT_CSS . '/responsive' . $css_ext,
        'deps' => array(),
    ),
);

return $css_files;
