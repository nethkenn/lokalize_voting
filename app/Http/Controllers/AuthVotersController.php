<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Request;



use Session;
use Redirect;


class AuthVotersController extends Controller
{
  
    
    function __construct()
    {
        // dd(session("is_login"));
        if(session("is_login")=="voters")
        {
           
        }
        else
        {
            if(session("is_login")=="admin")
            {
               return Redirect::to("/admin")->send();
            }
            else
            {
                return Redirect::to("/login")->send();
            }
            
            
        }
    }

    

}
