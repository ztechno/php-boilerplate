<?php

$route = get_route();

if(startWith($route,'app/db-')) return true;

if(startWith($route,'api'))
{
    return require 'api.php';
}

// check if installation is exists
$conn  = conn();
$db    = new Database($conn);

$installation = $db->single('application');
if(!$installation)
{
    if($route != "installation")
    {
        header("location:".routeTo('installation'));
        die();
    }
    
    return $route == "installation";

}

return require 'default.php';