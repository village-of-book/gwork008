<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        // ログインしていなければ、ログインページにリダイレクト
        // if(auth()->check()){
        //     return redirect()->route('login');
        // }
        // いいね.をつける機能
        $user = Auth:: user();
        $like = $post->likes()->where('user_id', $user->id);

        $post->likes()->create(['user_id' => $user->id]);

        return redirect()->back();
    }
}
