<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;


class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(2);
        $likedPosts = Post::withCount('likedUsers')->get();
       return view('main.index', compact('posts',  'randomPosts', 'likedPosts'));
    }
}
