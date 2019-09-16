<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


Class ApiController 
{
	public function login(Request $request )
	
	{
		$id = $request->get('id');
		$pw = $request->get('password');
		$user = User::where('email',$id)->where('password',$pw)->first();
		if($user){
			return $user->api_token;
		}else{
			abort(402,'failed');
		}
	}
}
