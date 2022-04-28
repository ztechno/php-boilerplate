<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if(file_exists('../vendor/autoload.php'))
    require '../vendor/autoload.php';
require '../functions.php';

// do before action
$beforeAction = require '../before-actions/index.php';
if($beforeAction)
{
    $page = config('default_page');
    $base_path = config('base_path');
    
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    
    if(startWith($uri, $base_path)) $uri = substr($uri, strlen($base_path));
    $uri = $uri == "" ? "/" : $uri;
    
    
    $page = $uri == '/' ? $page : $uri;

    if(isset($_GET['r'])) // r stand for route
    {
        $page = $_GET['r'];
    }
    
    load_page($page);
}
else
{
    load_page('errors/403');
}
die();