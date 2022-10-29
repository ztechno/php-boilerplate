<?php
if (!in_array(php_sapi_name(),["cli","cgi-fcgi"])) {
    die();
}

date_default_timezone_set('Asia/Jakarta');

require 'functions.php';

// cron action
$action = '';
foreach ($argv as $arg) {
    if(stringContains($arg,'console.php')) continue;
    $action=$arg;
}

if(file_exists('actions/'.$action.'.php'))
    require 'actions/'.$action.'.php';