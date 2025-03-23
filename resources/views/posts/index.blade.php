<?php
    // 現在認証しているユーザーを取得
    $user = auth()->user();

    use App\Models\Post;
    $query = Post::query();
    $failure_count = $query->where('user_id', Auth::id())->count();
    $failure_height = $failure_count * 0.9;

?>
@extends('layout')

@section('content')
<!-- 共通レイアウトに集約 -->
<!-- <div class="container mt-5"> -->

            <div class="alert alert-success text-center" role="alert">
            貴方のこれまでの失敗<?=$failure_count?>件を、厚さ0.9mmのコピー用紙で積み上げると<?=$failure_height?>mmの高さです
            </div>
    <!-- ページタイトル -->
    <h2>これまでの成功のもと</h2>

    <!-- 余白（レイアウト調整） -->
    <div class="mt-3">

    <!-- ボタン新規登録 -->
    <a href="{{ route('posts.create')}}" class="btn btn-primary mb -3">新規登録</a>
    </div>

    <!-- 余白（レイアウト調整） -->
    <div class="mt-3"></div>

    <!-- 検索・並び替えエリア -->
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
            <!-- 条件（検索） -->
            <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <select name="search_type" class="form-select">
                        <option value="all_mine" {{ request('search_type') == 'all_mine' ? 'selected' : ''}}>自分の失敗（すべて）</option>
                        <option value="share_mine" {{ request('search_type') == 'share_mine' ? 'selected' : ''}}>自分の失敗（公開のみ）</option>
                        <option value="secret_mine" {{ request('search_type') == 'secret_mine' ? 'selected' : ''}}>自分の失敗（非公開のみ）</option>
                        <option value="share_everyone" {{ request('search_type') == 'share_everyone' ? 'selected' : ''}}>みんなの失敗（公開のみ）</option>                
                    </select>

                    <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
                </div>
            </div>
            <!-- 条件（並び替え） -->
            <div class="col-md-2">
                <div class="input-group">
                    <select name="sort" class="form-select">

                        <option value="updated_newest" {{ request('sort') == 'updated_newest' ? 'selected' : '' }}>更新新しい順</option>
                        <option value="updated_oldest" {{ request('sort') == 'updated_oldest' ? 'selected' : '' }}>更新古い順</option>
                        <option value="created_newest" {{ request('sort') == 'created_newest' ? 'selected' : '' }}>登録新しい順</option>
                        <option value="created_oldest" {{ request('sort') == 'created_oldest' ? 'selected' : '' }}>登録古い順</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>タイトル昇順</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>タイトル降順</option>

                    </select>
                </div>
            </div>

            <!-- 余白（レイアウト調整） -->
            <div class="col-md-2">
            <!-- ボタン（検索・並び替え） -->
            <button type="submit" class="btn btn-primary">検索・並び替え</button>
            </div>
        </div>
    </form>
    
    @foreach($posts as $post)

            <!-- card 外枠 -->
            <div class="card mb-3">
                <div class="card-body">
                    <!-- card 投稿者 -->
                    <p class="text-muted" style="text-align: right">投稿者: {{ $post->user->name }}</p>

                    <!-- card タイトル -->
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

                    <!-- 余白（レイアウト調整） -->
                    <div class="mt-3"></div>

                    <div class="row">
                        <div class="col">
                            <!-- 公開・非公開の表示 -->
                            <p>
                            {!! $post->share ? '<i class="bi bi-people-fill" style="color:red"></i> 公開' : '<i class="bi bi-person-fill-lock"></i> 非公開' !!}
                            </p>
                        </div>


                        <div class="col">
                            <!-- いいね数の表示 -->
                            <p><i class="bi bi-exclamation-circle-fill" style="color:blue;"></i> {{ $post->likes->count() }} 件</p>
                        </div>

                        <div class="col">
                            <!-- コメント数の表示 -->
                            <p><i class="bi bi-chat-dots-fill" style="color:gray;"></i> {{ $post->comments->count() }} 件</p>                            
                        </div>

                        <div class="col">
                            <p class="text-muted">タイトル、失敗、成功の更新日時: </p>
                            <p class="text-muted">{{ $post->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>

                        <div>
                            <a href="{{ route('posts.show', $post->id)}}" class="btn btn-info">詳細</a>
                        </div>

                    </div>

                </div>
            </div>



    @endforeach
<!-- </div> -->
@endsection