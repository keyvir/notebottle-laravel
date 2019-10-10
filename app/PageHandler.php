<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class PageHandler 
{
    public function get($id)
    {
        return Page::find($id)->load('tags');
    }

    public function getList($args= [])
    {
        $query = $this->getQuery();
        
        $query = $query->when(isset($args['tag']),function($query)use($args){
            $query->whereHas('tags',function($query)use($args){
                $query->where('name','like','%'.$args['tag'].'%');
            });
        });
        $query = $query->when(isset($args['count']),function($query)use($args){
            $query->when(isset($args['offset']),function($query)use($args){
                $query->skip($args['offset']);
            });
            $query->limit($args['count']);
        });
        return $query->get()->load('tags');
    }

    public function getMyList($args= [])
    {
        $query = $this->getQuery();
        $query = $query->where('user_id',Auth::guard('api')->id());
        $query = $query->when(isset($args['tag']),function($query)use($args){
            $query->whereHas('tags',function($query)use($args){
                $query->where('name','like','%'.$args['tag'].'%');
            });
        });
        return $query->get()->load('tags');
    }

    public function store($args)
    {
        $page = new Page();
        $page->fill($args);
        $page->user_id = Auth::guard('api')->id();
        $page->save();
        return $page;
    }

    public function update(Page $page, $args)
    {
        $page->fill($args);
        $page->save();
        return $page;
    }

    public function remove(Page $page)
    {
        $page->delete();
    }

    private function getQuery()
    {
        $query = new Page();
        return $query;
    }
}