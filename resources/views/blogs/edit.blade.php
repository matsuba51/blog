@extends('layouts.app')

@section('content')
    <h1>ブログを編集</h1>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" required>
        </div>
        <div>
            <label for="body">内容</label>
            <textarea name="body" id="body" rows="4" required>{{ old('body', $blog->body) }}</textarea>
        </div>
        <button type="submit">更新する</button>
    </form>
@endsection