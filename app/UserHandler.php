<?php

namespace App;

class UserHandler 
{
    public function register($id, $password)
    {
		$user = new User([
			'email'=>$id,
			'password'=>$password
		]);
		$user->save();
		$user->api_token = hash('sha256',$user->id.$user->password);
		$user->save();
		return $user;
    }
}