@extends('layout')

@section('content')
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
                        <option value="partial" {{ request('search_type') == 'partial' ? 'selected' : ''}}>部分一致</option>                
                        <option value="prefix" {{ request('search_type') == 'prefix' ? 'selected' : ''}}>前方一致</option>
                        <option value="suffix" {{ request('search_type') == 'suffix' ? 'selected' : ''}}>後方一致</option>
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
        @if(Auth::check() && Auth::id() === $post->user_id)
            <!-- card 外枠 -->
            <div class="card mb-3">
                <div class="card-body">
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
                            <a href="{{ route('posts.show', $post->id)}}" class="btn btn-info">詳細</a>
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

                    </div>

                </div>
            </div>

        @endif

    @endforeach

@endsection