<?php

namespace App\Models;


class feedback
{
    public $textarea;
    function feedback($text_area)
    {
     
        $textarea=$text_area;
        return $textarea;
    }

}