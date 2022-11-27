<?php

$auth = auth();
if(!isset($auth->user) && !in_array($route, ['auth/login','installation']))
{
    header("location:".routeTo('auth/login'));
    die();
}

if(isset($auth->user) && $route == 'auth/login')
{
    header("location:".routeTo(app('after_login_page')));
    die();
}

// check if route is allowed
if(isset($auth->user) && isset($auth->user->id) && !is_allowed($route, $auth->user->id) && $route != 'auth/logout')
{
    return false;
}

if(startWith($route,'crud') && isset($_GET['table']) && !isset(config('fields')[$_GET['table']]))
{
    header("location:".routeTo('error/404'));
    die();
}

return true;
