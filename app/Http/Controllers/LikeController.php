<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{    
    /**
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function submitLikes(Request $request): RedirectResponse
    {
        $type = $request->type === 'Post' ? Post::class : Comment::class;
        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $request->id,
            'likeable_type' => $type
        ]);
        return back();
    } 

    /**
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function deleteLikes(Request $request): RedirectResponse
    {
        $like = Like::where('likeable_id',$request->id)->where('user_id',auth()->id());
        $like->delete();
        return back();
    }
}