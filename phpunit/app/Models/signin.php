<?php

namespace App\Models;


class signin
{

public $name;
public $mobile;
public $email;
public $password;
public $role;
public function newsign($name,$mobile,$email,$password,$role)
  {
    
    
    
    if(!empty($role) && ($role=='student' || $role=='admin' || $role=='prof'))
    {
      if(!empty($name))
      {
        if(!empty($mobile) && strlen($mobile)==10)
        {
          if(!empty($email))
          {
            if(!empty($password)&& strlen($mobile)>8)
            {
              return true;
            }
            else
            {
              return false;
            }  
          }
          else
          {
              return false;
          }
        }
        else
        {
          return false;
          
        }
      }
      else
      {
         return false;
      }
      
    }
    else
    {
      return false;
    }
  }
}