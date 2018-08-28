<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use stdClass;
use Input;
use DateTime;
use Session;
use Redirect;
use Validator;
use Crypt;
use App\Globals\Login;
use Carbon\Carbon;

use App\Models\Tbl_voting_user;

class LoginController extends Controller
{
   public function login()
    {
    	Session::forget('session');

    	return view('login');

    	# code...

		// if(Request::isMethod("post")) 
		// {
		// 	$email 		= Request::input('UserNameInput');
		// 	$password 	= Request::input('PasswordNameInput');

		// 	$user       = Tbl_voting_user::where('user_email',$email)->where('user_password',$password)->first();
			
		// 	if ($user) 
		// 	{	
			
		// 		if($user['user_type']==0)
		// 		{
		// 			$login = Login::login($email,$password);
		// 			$redirect = $login ? Redirect::to("/employee") : Redirect::to("/login");
		// 			return $redirect;
		// 		}
		// 		else
		// 		{
		// 			return Redirect::to("/admin");
		// 		}
				
		// 	}
		// 	else
		// 		{
		// 		return Redirect::to("/login")->with('message', "The E-Mail / Password is incorrect.")->withInput();
		// 		}
		// }
		// else
		// {	
		// 	return view('login');
		// }
    }	
    public function login_submit()
    {
    	if(Request::isMethod("post")) {
    	$email 		= Request::input('UserNameInput');
		$password 	= Request::input('PasswordNameInput');

		$user       = Tbl_voting_user::where('user_email',$email)->where('user_password',$password)->first();
			
		if($user) 
		{	
		
			Session::put('session',$user->user_id);

			if($user->user_type == 0)
			{
				return Redirect::to("/employee");
			}
			else
			{
				return Redirect::to("/admin");
			}
			
			
		}
		else
		{
			return Redirect::back()->withErrors(['Error Credentials', 'The Message']);
		}

    	}

    }

    public function index()
    {
    	return view('index');
    }
}
