<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class PageHandler 
{
    public function get($id)
    {
        return Page::find($id)->load('tags');
    }

    public function getList()
    {
        $query = $this->getQuery();
        return $query->get()->load('tags');
    }

    public function getMyList()
    {
        $query = $this->getQuery();
        $query = $query->where('user_id',Auth::guard('api')->id());
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