<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
    
    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
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
        
    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return Post::with(['user','comments','likes'])->get();
    }
}
