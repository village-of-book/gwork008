@extends('layout')

@section('content')
    <h2>これまでの成功のもと</h2>
    <div class="mt-3">
    <a href="{{ route('posts.create')}}" class="btn btn-primary mb -3">新規登録</a>
    </div>

    <div class="mt-3"></div>

    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
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

            <div class="col-md-2">
                <div class="input-group">
                    <select name="sort" class="form-select">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>新しい順</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>タイトル昇順</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>タイトル降順</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
            <button type="submit" class="btn btn-primary">検索・並び替え</button>
            </div>
        </div>
    </form>

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="card-text">{{ $post->content_failure }}</p>
                <p class="card-text">{{ $post->content_success }}</p>
                <a href="{{ route('posts.show', $post->id)}}" class="btn btn-info">詳細</a>
            </div>

        </div>
    @endforeach
    <!-- ページネーションのリンク -->
     <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
     </div>
@endsection