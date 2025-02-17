@extends('layouts.admin')

@section('content')
    <h1>新規ブログ作成</h1>

    <form action="{{ route('admin.blogs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
@endsection