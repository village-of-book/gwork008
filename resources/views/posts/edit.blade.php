@extends('layout')

@section('content')
    <h2>失敗の編集</h2>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="md-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title}}" required>
        </div>
        <div class="row">
            <div class="col">
                <label for="content_failure" class="form-label">✖︎失敗✖︎</label>
                <textarea name="content_failure" class="form-control" rows="5" required> {{ $post->content_failure}}</textarea>
            </div>
            <div class="col">
                <label for="content_success" class="form-label">⚪︎成功⚪︎</label>
                <textarea name="content_success" class="form-control" rows="5" required>{{ $post->content_success}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">更新</button>
        <a href="{{ route('posts.show', $post->id)}}" class="btn btn-secondary">戻る</a>
    </form>

@endsection