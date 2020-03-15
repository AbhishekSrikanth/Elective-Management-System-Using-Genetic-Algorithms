<?php

class SampleTest extends \PHPUnit_Framework_TestCase
{
    //
    public function test_login1()
    {
    $user=new \App\Models\User;
    
    $this->assertFalse($user->newlogin('','' ));
    }


    public function test_login2()
    {
    $user=new \App\Models\User;
    
    $this->assertFalse($user->newlogin('rajesh','' ));
    }

    public function test_login3()
    {
    $user=new \App\Models\User;
    
    $this->assertFalse($user->newlogin('','pass' ));
    }

    public function test_login4()
    {
    $user=new \App\Models\User;
    
    $this->assertTrue($user->newlogin('resk','pass' ));
    }

    //no domain name
    public function test_for_email_regex1()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("raj"));
    }

    //correct email
    public function test_for_email_regex2()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertTrue($user->email_validation("emman@gmail.com"));
    }

    //starting with special charactor
    public function test_for_email_regex3()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("@gmail.com"));
    }

    //no @ symbol
    public function test_for_email_regex4()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("rajgmail.com"));
    }

    //no dot symbol

    public function test_for_email_regex5()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("rajgmailcom"));
    }
    
    //more special characactors
    public function test_for_email_regex6()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation("rajgmail_com"));
    }

    //no value
    public function test_for_email_regex7()
    {
    $user=new \App\Models\emailregex;
    
    $this->assertFalse($user->email_validation(" "));
    }


    //values not given completely
    public function test_for_signin1()
    {
    $user=new \App\Models\signin;
    
    $this->assertFalse($user->newsign("rajesh","97079711","","",""));
    }


    //password did not meet requirements
    public function test_for_signin2()
    {
    $user=new \App\Models\signin;
    
    $this->assertFalse($user->newsign("rajesh","9707971111","a","v","b"));
    }

    //mobile number wrong
    public function test_for_signin3()
    {
    $user=new \App\Models\signin;
    
    $this->assertFalse($user->newsign("rajesh","97079711","a","v","b"));
    }
    //all values correct
    public function test_for_signin4()
    {
    $user=new \App\Models\signin;
    
    $this->assertTrue($user->newsign("rajesh","9707971111","raj@gmail.com","1234567891","prof"));
    }

    //empty values passed

    public function test_for_signin5()
    {
    $user=new \App\Models\signin;
    
    $this->assertFalse($user->newsign("","","","",""));
    }

    //role given wrong

    public function test_for_signin6()
    {
    $user=new \App\Models\signin;
    
    $this->assertFalse($user->newsign("rajesh","9707971111","raj@gmail.com","1234567891","none"));
    }

    //feedbacktest
    public function test_for_feedback1()
    {
    $user=new \App\Models\feedback;
    
    $this->assertSame($user->feedback("The experience was good"),"The experience was good");
    }


}