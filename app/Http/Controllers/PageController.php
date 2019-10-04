<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\PageHandler;
use App\UserHandler;
use App\TagHandler;
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

    public function getList(PageHandler $pageHandler, Request $request)
    {
        return $pageHandler->getList($request->all());
    }

    public function getMyList(PageHandler $pageHandler, Request $request)
    {
        return $pageHandler->getMyList($request->all());
    }

    public function store(PageHandler $pageHandler, TagHandler $tagHandler, Request $request)
    {
        $page = $pageHandler->store($request->only('content'));
        if($request->has('tags')){
            $tagHandler->store($page->id,$request->get('tags'));
        }
        return 'complete';

    }

    public function update(PageHandler $pageHandler, TagHandler $tagHandler, Page $page, Request $request)
    {
        $pageHandler->update($page, $request->only(['content']));
        if($request->has('tags')){
            $tagHandler->store($page->id,$request->only('tags'));
        }
        return 'complete';
    }

    public function remove(PageHandler $pageHandler, Page $page)
    {
        return $pageHandler->remove($page);
    }

}