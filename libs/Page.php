<?php

class Page 
{
    static $title;
    static function set_title($title)
    {
        self::$title = $title;
    }

    static function get_title()
    {
        return self::$title;
    }
}