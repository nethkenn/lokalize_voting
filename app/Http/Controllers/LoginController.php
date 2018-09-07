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
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Facade;
use App\Globals\Login;
use Carbon\Carbon;

use App\Models\Tbl_voting_user;
use App\Models\Tbl_user_voting_status;

class LoginController extends Controller
{
   public function login()
    {
    	Session::forget('session');

    	return view('login');

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
    public function logout()
    {
    	Session::start('session');
   		Session::flush('session');
		return Redirect::to('/');
    	
    }
    public function login_submit()
    {
    Session::start('session');
    if(Request::isMethod("post")) 
    {
    	$email 		= Request::input('UserNameInput');
    	$username   = Request::input('UserNameInput');
		$password 	= Request::input('PasswordNameInput');

		$user       = Tbl_voting_user::where('user_password', $password)
									   ->where(function ($query) use ($email, $username) {
											$query->where('user_email',$email)
												  ->orwhere('user_name',$username);
										})
									   ->first();
		if($user) 
		{	
			$status     = Tbl_user_voting_status::where('user_id',$user->user_id)->value('voting_status');
			Session::put('session',$user->user_id);
			if($status == 'Pending')
			{
				
				if($user->user_type == 0)
				{
					Alert::success('Login Successfully', $user->user_first_name);
					return Redirect::to("/voters");
				}
				
			}
			else if($user->user_type == 1)
				{
					// dd($user);
					Alert::success('Login Successfully', $user->user_first_name);
					return Redirect::to("/admin");

				}

			elseif(isset($status) && $status == "Completed")
			{
				
				return Redirect::back()->withErrors(['You already done to Vote!', 'The Message']);
			}
			else
			{
				
				return Redirect::back()->withErrors(['Error Credential', 'The Message']);
			}
		}
		else
		{
			
			return Redirect::back()->withErrors(['Error Credential', 'The Message']);
		}
	}
	}

    public function index()
    {
    	return view('index');
    }
	
}
