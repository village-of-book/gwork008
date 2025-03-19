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
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>新しい順</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順</option>
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

                    <a href="{{ route('posts.show', $post->id)}}" class="btn btn-info">詳細</a>

                    <!-- 暫定対策 -->
                    <!-- いいね数の表示 -->
                    <p>{{ $post->likes->count() }} 件の<i class="bi bi-exclamation-circle-fill" style="color:blue;"></i></p>
                    <!-- </form> -->

                    <!-- JavaScriptで非同期通信の処理 -->                    
                    <!-- いいねボタン -->
                    <button id="likeButton" class="btn {{ $post->likes->contains('user_id', auth()->id()) ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </button>
                    <!-- JavaScriptで非同期通信の処理 -->                    
                    <!-- いいね数の表示 -->
                    <p id="likeCount">{{ $post->likes->count() }} 件の注意！</p>

                </div>
            </div>

        @endif

    @endforeach
    <!-- ページネーションのリンク -->

        <!-- 無しカウントされないJavaScriptで非同期通信の処理 -->
        <script>
            $(document).ready(function(){
                $('#likeButton').on('click', function(e){
                    e.preventDefault();

                    const button = $(this);
                    const likeCountElement = $('#likeCount');

                    $.ajax({
                        url: "{{ route('posts.like', $post->id) }}",
                        method: 'POST',
                        data: {},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if(data.liked){
                                button.removeClass('btn-outline-primary').addClass('btn-primary');
                                button.html('<i class="bi bi-exclamation-circle-fill"></i>');
                            }else {
                                button.removeClass('btn-primary').addClass('btn-outline-primary');
                                button.html('<i class="bi bi-exclamation-circle"></i>');
                            }

                            likeCountElement.text(data.like_count + ' 件の注意だよ')
                        },
                        error: function(error) {
                            console.error('Error', error);
                        }
                    });
                });
            });
        </script>

@endsection