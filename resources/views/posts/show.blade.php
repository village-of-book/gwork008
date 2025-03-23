<?php
    // 現在認証しているユーザーを取得
    $user = auth()->user();
?>
@extends('layout')

@section('content')
    <!-- ページタイトル -->
    <h2>失敗の詳細</h2>
    <!-- ページリンク（indexへ） -->
    <a href="{{ route('posts.index')}}" class="btn btn-secondary">一覧に戻る</a>
 
    <!-- レイアウト調整の行 -->
    <div class="mt-3"></div>

        <!-- card 外枠 -->
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>

                    <div class=row>
                    <!-- card 中身 -->
                        <!-- card 失敗 -->
                        <div class="col">
                            <div class="card h-100">
                                <h5 class="card-header">✖︎失敗✖︎</h5>
                                <div class="card-body">
                                    <p class="card-text">{{ $post->content_failure }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- card 成功 -->  
                        <div class="col">
                            <div class="card h-100">
                                <h5 class="card-header">⚪︎成功⚪︎</h5>
                                <div class="card-body">
                                    <p class="card-text">{{ $post->content_success }}</p>
                                </div>
                            </div>
                        </div>
            </div>

            <div class="mt-3"></div>

            <!-- 公開・非公開の表示 -->
            <p>
            {!! $post->share ? '<i class="bi bi-people-fill" style="color:red"></i> 公開' : '<i class="bi bi-person-fill-lock"></i> 非公開' !!}
            </p>

            <div class="mt-3"></div>

            @if(Auth::check() && Auth::id() === $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">編集</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>

                <div class="mt-3"></div>

            @endif
        </div>

    </div>
@if(Auth::check() && Auth::id() === $post->user_id)
    <!-- コメントフォーム -->
    <h4>※必要に応じて、注意ボタンをクリック（より注意を払う必要が有るなら、連打しよう！）</h4>

    <!-- いいねボタン -->
     <form action="{{ route('posts.like', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn {{ $post->likes->contains('user_id', auth()->id()) ? 'btn-outline-primary' : 'btn-primary' }}">
        {!! $post->likes->contains('user_id', auth()->id()) ? '<i class="bi bi-exclamation-circle-fill"></i>' : '<i class="bi bi-exclamation-circle"></i>' !!}
        </button>
     </form>
    <!-- いいね数の表示 -->
    <p>{{ $post->likes->count() }} 件の注意！</p>
@endif

@if(Auth::check() && Auth::id() === $post->user_id)
    <!-- コメントフォーム -->
     <h3>コメントを投稿する</h3>
     @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">コメント内容</label>
                <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">コメント投稿</button>
        </form>
    @else
        <p>コメントを投稿するには、ログインが必要です。</p>

    @endauth
    @endif
    <!-- レイアウト調整の行 -->
    <div class="mt-3"></div>

    <!-- コメント一覧 -->
     <h3>コメント一覧</h3>
     @if ($comments->isEmpty())
        <p>コメントは未だ有りません。</p>
    @else

        @foreach($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="text-muted">投稿日時: {{ $comment->created_at->format('Y-m-d H:i:s') }}</p>
                </div>

            </div>
        @endforeach
    @endif

        <!-- ページネーションのリンク -->
        <div class="d-flex justify-content-center mt-4">
        {{ $comments->links() }}
        </div>

@endsection