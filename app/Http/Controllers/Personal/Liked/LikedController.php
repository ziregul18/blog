<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;


class LikedController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->likedPosts;
        //dd($posts);
         return view('personal.liked.index', compact('posts'));
    }
}
