@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-4">ログイン</h1>

        <!-- エラーメッセージを表示 -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-gray-300">メールアドレス</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-300">パスワード</label>
                <input type="password" name="password" id="password" required
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-300">ログイン状態を保持</label>
            </div>
            
            <button type="submit" class="btn-primary w-full">ログイン</button>
        </form>

        <p class="mt-4 text-center">
            まだアカウントを作成していない場合は、
            <a href="{{ route('register') }}" class="text-blue-400 hover:underline">新規登録</a>
            してください。
        </p>

        <div class="mt-4 text-center">
            <a href="{{ route('blogs.index') }}" class="btn-secondary">戻る</a>
        </div>
    </div>
@endsection
