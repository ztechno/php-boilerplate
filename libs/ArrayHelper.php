<?php

class ArrayHelper
{

    private $main_array = [];

    function __construct($arr)
    {
        $this->main_array = $arr;
    }

    function toObject()
    {
        return json_decode(json_encode($this->main_array));
    }
}