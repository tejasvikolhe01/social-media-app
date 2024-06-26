<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
     /**
     * @return Response
     */

    public function create(): Response
    {
        return Inertia::render('/dashboard');
    }

    public function createPost(Request $request): RedirectResponse
    {
        $request->validate([ 
            'post_content' => 'required'
        ]);

        Post::create([
            'user_id'      => auth()->id(),
            'post_content' => $request->post_content,
        ]);

        return redirect(route('dashboard', absolute:false));
    }

    public function getPosts() 
    {
        return Post::with('user')->get();
    }
}
