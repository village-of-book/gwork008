@extends('layout')

@section('content')
    <h2>新たな成功のもと</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="md-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" required>
            @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <label for="content_failure" class="form-label">✖︎失敗✖︎</label>
                <textarea name="content_failure" class="form-control" rows="5" required></textarea>
                @error('content_failure')
                    <div class="text-danger">{{ $errors->first('content_failure') }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="content_success" class="form-label">⚪︎成功⚪︎</label>
                <textarea name="content_success" class="form-control" rows="5" required></textarea>
                @error('content_success')
                    <div class="text-danger">{{ $errors->first('content_success') }}</div>
                @enderror
            </div>
        </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-success">投稿</button>
    </div>
    </form>
    <div class="mt-3">
        <a href="{{ route('posts.index')}}" class="btn btn-secondary">戻る</a>
    </div>

@endsection