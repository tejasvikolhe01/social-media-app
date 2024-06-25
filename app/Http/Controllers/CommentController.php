<?php
namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CommentController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('/dashboard');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function createComment(Request $request): RedirectResponse
    {
        $request->validate([
            'comment_text'=>'required',
        ]);
        
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'comment_text' => $request->comment_text,
            'post_id' => $request->post_id
        ]);
        return redirect(route('dashboard', absolute:false));
    }
}
