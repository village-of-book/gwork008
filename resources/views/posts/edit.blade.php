@extends('layout')

@section('content')
    <h2>失敗の編集</h2>

        <!-- 余白（レイアウト調整） -->
        <div class="mt-5">

        <!-- 余白（レイアウト調整） -->
        <div class="mt-1">

        <!-- 検索・並び替えエリア -->
        <!-- 検索キーワード入力エリア -->
        <div class="row">
            <div class="col-md-9">
                    <input id="keyword_area" type="text" name="search" class="form-control" placeholder="検索キーワードを〜〜で入力すると、タイトル末尾に＃〜〜が追加されます" value="{{ request('search') }}">
            </div>

            <!-- 余白（レイアウト調整） -->
            <div class="col-md-3">
                <!-- ボタン（検索・並び替え） -->
                <button id="keyword_set" class="btn btn-primary">タイトルに追加</button>
            </div>
        </div>


    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="md-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title}}" required>
        </div>

            <!-- 余白（レイアウト調整） -->
            <div class="mt-3">

        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <!-- <label for="content_failure" class="form-label">✖︎失敗✖︎</label> -->
                    <h5 class="card-header">✖︎失敗✖︎</h5>
                    <textarea name="content_failure" class="form-control" rows="5" required> {{ $post->content_failure}}</textarea>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <!-- <label for="content_success" class="form-label">⚪︎成功⚪︎</label> -->
                    <h5 class="card-header">⚪︎成功⚪︎</h5>
                    <textarea name="content_success" class="form-control" rows="5" required>{{ $post->content_success}}</textarea>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">更新</button>
        </div>

        <div class="mt-3">
            <a href="{{ route('posts.show', $post->id)}}" class="btn btn-secondary">戻る</a>
        </div>
    </form>

    <script>
        $('#keyword_set').on('click', function(){
            document.getElementsByName("title")[0].value += ' #' + $('#keyword_area').val() + ' ';
            $('#keyword_area').val('');
        });

    </script>

@endsection