<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\View\View;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('posts', ['posts' => PostResource::collection(Post::all())]);
    }
}
