<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagHandler
{
    //
    public function store($pageId, $titles)
    {
        $page = Page::find($pageId);
        $page->tags()->detach();
        foreach($titles as $title)
        {
            $tag = Tag::firstOrCreate([
                'title'=>$title
            ]);
            $tag->pages()->attach($pageId);
        }
    }
}
