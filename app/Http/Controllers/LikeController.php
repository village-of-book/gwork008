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
        // $post_id = $post('post_id', $post->id);

        $post->likes()->create(['user_id' => $user->id]);

        // jsonで、値を取ってくる
        return response()->json([
            // 「いいね」がされているか、存在をtrue or faultsで値を取ってくる
            'liked' => $post->likes()->where('user_id', $user->id)->exists(),
            // 「いいね」のされた数を値で取ってくる
            'like_count' => $post->likes()->count(),
            // 「いいね」のされたpost_idの値を取ってくる
            // 'liked_post_id' => $post['post_id']
        ]);
        // 同じページに戻ってくる処理
        // return redirect()->back();
    }
}
