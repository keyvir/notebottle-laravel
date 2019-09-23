<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\PageHandler;
use App\UserHandler;
use App\Http\Middleware\Cors;

class PageController extends Controller 
{
	public function __construct()
	{
		$this->middleware(Cors::class);
    }
    
    public function get(PageHandler $pageHandler, $id)
    {
        return $pageHandler->get($id);
    }

    public function getList()
    {
        return $pageHandler->getList();
    }

    public function getMyList()
    {
        return $pageHandler->getMyList();
    }

    public function store(Request $request)
    {
        return $pageHandler->store($request->only('content'));
    }

    public function update(Page $page, Request $request)
    {
        return $pageHandler->update($page, $request->all());
    }

    public function remove(Page $page)
    {
        return $pageHandler->remove($page);
    }

}