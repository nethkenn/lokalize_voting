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

    }	
    public function logout()
    {
    	
    	// Session::start('session');
   		// Session::flush();
   		
   		Session::forget('is_login');
   		return view('index');
   		// header("Refresh:0; url=index.php");
		// return Redirect::to('/');

    	
    }
    public function login_submit()
    {
    	
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
						// Alert::success('Login Successfully', $user->user_first_name);
						session::put("is_login","voters");
						return Redirect::to("/voters");
					}
					
				}
				else if($user->user_type == 1)
				{
					// Alert::success('Login Successfully', $user->user_first_name);
					Toastr::success('Wrong Username or Password.', 'Invalid Credential');
					session::put("is_login","admin");
					return Redirect::to("/admin");

				}

				else if(isset($status) && $status == "Completed")
				{	
					Toastr::info('Your vote is Successfully Submitted.', 'Completed!');
					return view('login');
				}
				else
				{	
					Toastr::warning('Wrong Username or Password.', 'Invalid Credential!');
					return view('login');
				}
			}
			else
			{
				Toastr::warning('Wrong Username or Password.', 'Invalid Credential');
				// return Redirect::to("/login")->send();
				return view('login');
			}
		}
	}

    public function index()

    {
    	session::forget('error');
    	return view('index');
    }

    public function results()
    {
    	return view('results');
    }
	
}
