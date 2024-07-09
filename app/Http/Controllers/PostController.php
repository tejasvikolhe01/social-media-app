<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return LengthAwarePaginator
     */
    public function getPosts(): LengthAwarePaginator
    {
        return Post::orderBy('created_at', 'DESC')->with(['user','comments','likes'])->paginate(3);
    }
}
