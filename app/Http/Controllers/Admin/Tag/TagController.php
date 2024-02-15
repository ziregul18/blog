<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;


class TagController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::all();
       return view('admin.tag.index', compact('tags'));
    }
}
