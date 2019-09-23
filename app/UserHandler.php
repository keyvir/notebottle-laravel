<?php

namespace App;

class UserHandler 
{
    public function register($id, $password, $name)
    {
		$user = new User([
			'email'=>$id,
            'password'=>$password,
            'name'=>$name
		]);
		$user->save();
		$user->api_token = hash('sha256',$user->id.'-'.$user->password);
		$user->save();
		return $user;
    }
}