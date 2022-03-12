<?php

$conn  = conn();
$db    = new Database($conn);

$db->get_error = true;
$installation = $db->single('application');
if(stringContains($installation,"doesn't exist"))
{
    $myfile = fopen("../migrations/init.sql", "r") or die("Unable to open file!");
    $query  = fread($myfile,filesize("../migrations/init.sql"));
    fclose($myfile);
    
    $db->query = $query;
    $db->exec('multi_query');
    
    echo "DB Init Success";
    die();
}
