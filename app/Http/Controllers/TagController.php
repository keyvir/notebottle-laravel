<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Middleware\Cors;

class TagController extends Controller 
{
	public function __construct()
	{
		$this->middleware(Cors::class);
    }

    public function getList()
    {
        return Tag::all();
    }

}