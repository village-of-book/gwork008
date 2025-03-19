@extends('layout')

@section('content')
    <!-- ページタイトル -->
    <h2>新たな成功のもと</h2>

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
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="md-3">
            <!-- card タイトル -->
            <label for="title" class="form-label">タイトル</label>
            <input id="title_area" type="text" name="title" class="form-control" required>
            @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>

        <!-- 余白（レイアウト調整） -->
        <div class="mt-3">

        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <h5 class="card-header">✖︎失敗✖︎</h5>
                    <textarea name="content_failure" class="form-control" rows="5" required></textarea>
                    @error('content_failure')
                        <div class="text-danger">{{ $errors->first('content_failure') }}</div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <h5 class="card-header">⚪︎成功⚪︎</h5>
                    <textarea name="content_success" class="form-control" rows="5" required></textarea>
                    @error('content_success')
                        <div class="text-danger">{{ $errors->first('content_success') }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">投稿</button>
        </div>
    </form>
    <div class="mt-3">
        <a href="{{ route('posts.index')}}" class="btn btn-secondary">戻る</a>
    </div>

    <!-- キーワド設定コード始まり -->
    <script>
        $('#keyword_set').on('click', function(){
            document.getElementsByName("title")[0].value += ' #' + $('#keyword_area').val() + ' ';
            $('#keyword_area').val('');
        });

    </script>
    <!-- キーワド設定コード終わり -->

@endsection