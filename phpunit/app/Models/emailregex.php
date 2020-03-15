<?php

namespace App\Models;


class emailregex
{

    public $str;
   public function email_validation($str){ 
        return (!preg_match( 
        '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^', $str)) 
        ? FALSE : TRUE; 
        } 
}