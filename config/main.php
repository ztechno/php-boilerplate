<?php

$parent_path = '../';
if (in_array(php_sapi_name(),["cli","cgi-fcgi"])) {
    $parent_path = '';
}

$menu = require $parent_path . 'config/menu.php';
$icon_menu = require $parent_path . 'config/icon_menu.php';
$tablefields = require $parent_path . 'config/tablefields.php';
$lang = require $parent_path . 'config/lang.php';
$app = require $parent_path . 'config/app.php';

$config = [
    'default_page' => 'index',
    'after_login_page' => 'default/index',
    'auth' => 'session', //JWT or Session
    'menu' => [
        'menu' => $menu,
        'icon' => $icon_menu
    ],
    'lang' => $lang,
    'fields' => $tablefields,
    'pretty_url' => true,
    'theme' => [
        'header_color'     => 'blue',
        'top_navbar_color' => 'blue2',
        'sidebar_color'    => 'nav-primary',
        'panel_color'      => 'bg-primary-gradient',
        'button_main_color'=> 'btn-primary',
    ]
];

$app['base_url'] = $app['app_protocol'].'://'.$app['app_domain'].($app['app_port']!=''?':'.$app['app_port']:'');

return array_merge($config, $app);