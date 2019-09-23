<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Middleware\Cors;
use App\UserHandler;


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

	public function register(Request $request, UserHandler $handler)
	{
		$request->validate([
			'id'=>'required|unique:users',
			'password'=>'required'
		]);
		$id = $request->get('id');
		$pw = $request->get('password');

		$user = $handler->register($id,$pw);

		return $user->api_token;
	}
}
