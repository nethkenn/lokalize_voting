<?php
namespace App\Globals;
use App\Models\Tbl_voting_user;


use Session;
use Redirect;
/**
 * 
 */
class Login
{
	
	function __construct()
	{
		# code...
	}

	public static function login($username,$password)
	{

		$check_account = Tbl_voting_user::where("user_email", $username)->where("user_password", $password)->first();
$user_id =1;
		Session::put('session',1);



		// if($check_account)
		// {
		// 	$session["user_id"] = $check_account->user_id;
		// 	$session["user_type"] = $check_account->user_type;
		// 	session($session);

		// 	return true;
		// }
		return Redirect::to("/employee");

	}

	public static function check_login()
	{
		$user_type 	= session("user_type");
		$user_id 	= session("user_id");

		if($user_type != 0)
		{
			return false;
		}

		$member = Tbl_voting_user::where("user_id", $user_id)->first();

		if($member)
		{
			return $member;
		}
		else
		{
			return false;
		}
	}
}
?>