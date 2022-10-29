<?php

$parent_path = '../';
if (in_array(php_sapi_name(),["cli","cgi-fcgi"])) {
    $parent_path = '';
}

$conn  = conn();
$db    = new Database($conn);

$db->get_error = true;
$installation = $db->single('application');
if(stringContains($installation,"doesn't exist"))
{
    $myfile = fopen($parent_path . "migrations/init.sql", "r") or die("Unable to open file!");
    $query  = fread($myfile,filesize($parent_path . "migrations/init.sql"));
    fclose($myfile);
    
    $db->query = $query;
    $db->exec('multi_query');
    
    echo "DB Init Success";
    die();
}
