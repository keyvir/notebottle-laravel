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

    public function search(Request $request)
    {
        $tag = $request->get('tag');
        $keyword = $request->get('keyword');
        $pages = Page::when($tag,function($query)use($tag){
            $query->whereHas('tags',function($query)use($tag){
                $query->where('name',$tag);
            });
        })->when($keyword,function($query)use($keyword){
            $query->where(function($query)use($keyword){
                $query->whereHas('tags',function($query)use($keyword){
                    $query->where('name','like','%'.$keyword.'%');
                });
            })->orWhere(function($query)use($keyword){
                $query->where('content','like','%'.$keyword.'%');
            });
        })->with('tags')->get();
        return $pages;
    }

}