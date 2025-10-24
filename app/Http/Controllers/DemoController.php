<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Inertia\Inertia;

class DemoController extends Controller
{
    //
    public function index()
    {
        $users = User::with('posts.comments', 'posts.categories')->get();
        return Inertia::render('posts/index', ['users' => $users]);
    }

    public function showPost($id)
    {
        $post = Post::with('user', 'comments', 'categories')->findOrFail($id);
        return Inertia::render('Post', ['post' => $post]);
    }
}
