<?php

class emailtest extends \PHPUnit_Framework_TestCase
{
    public function test_login1()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("raj"));
    }
}