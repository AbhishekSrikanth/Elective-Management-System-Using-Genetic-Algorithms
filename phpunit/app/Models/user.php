<?php

namespace App\Models;


class User
{

    public $email;
    public $password;
    public function newlogin($email,$password)
    {
      
      
      if(!empty($email))
      {
        if(!empty($password))
        {
            return true;
        }
        else{
            return false;
        }
    }
    else
    {
        return false;
    }
 
    }
         
              
            
    }

