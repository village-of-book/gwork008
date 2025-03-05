@extends('layout')

@section('content')
    <h2>失敗の詳細</h2>
    <a href="{{ route('posts.index')}}" class="btn btn-secondary">一覧に戻る</a>
 
    <!-- レイアウト調整の行 -->
    <div class="mt-3"></div>

        <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="card-text">{{ $post->content_failure }}</p>
            <p class="card-text">{{ $post->content_success }}</p>
            <!-- <a href="{{ route('posts.index')}}" class="btn btn-secondary">戻る</a> -->
            @if(Auth::check() && Auth::id() === $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">編集</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            @endif
        </div>
    </div>

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

    <!-- ページネーションのリンク -->
    <div class="d-flex justify-content-center mt-4">
    {{ $comments->links() }}
    </div>
    @endauth

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
                    <p class="text-muted">投稿日時: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                </div>

            </div>
        @endforeach
    @endif

        <!-- ページネーションのリンク -->
        <div class="d-flex justify-content-center mt-4">
        {{ $comments->links() }}
        </div>
@endsection