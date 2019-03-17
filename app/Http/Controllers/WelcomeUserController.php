<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    Public function __invoke($name,$nickname=null)
    {
    	if($nickname){
        return "Welcome {$name}, your nickname is {$nickname}";
	    }else {
	        return "Welcome {$name}, you don't have nickname";
	    }

    }
}
