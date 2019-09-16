<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Middleware\Cors;


Class ApiController extends Controller 
{
	public function __construct()
	{
		$this->middleware(Cors::class);
	}

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
