<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Facade;

use Request;

use Session;
use Redirect;


class AuthController extends Controller
{
  
    
    function __construct()
    {
        // dd(session("is_login"));
        if(session("is_login")=="admin")
        {
            Toastr::success('Login Successfully', 'Invalid Credential');
        }
        else
        {
            if(session("is_login")=="voters")
            {
               return Redirect::to("/voters")->send();
            }
            else
            {
                // header("Refresh:0");
                // header("Refresh:0; url=/login");
                return Redirect::to("/login")->send();
            }
            
            
        }

    }

}
