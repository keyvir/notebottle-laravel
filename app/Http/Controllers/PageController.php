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

    public function getList(PageHandler $pageHandler)
    {
        return $pageHandler->getList();
    }

    public function getMyList(PageHandler $pageHandler)
    {
        return $pageHandler->getMyList();
    }

    public function store(PageHandler $pageHandler,Request $request)
    {
        return $pageHandler->store($request->only('content'));
    }

    public function update(PageHandler $pageHandler, Page $page, Request $request)
    {
        return $pageHandler->update($page, $request->all());
    }

    public function remove(PageHandler $pageHandler, Page $page)
    {
        return $pageHandler->remove($page);
    }

}