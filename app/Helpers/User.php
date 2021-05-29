<?php

namespace App\Helper;

use App\Models\User as UserModel;
use Auth;

class User
{
	
	public static function can($perm){
		$user = Auth::user();
		
	}

}
