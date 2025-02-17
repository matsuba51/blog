@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-4">新規登録</h1>

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

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-300">名前</label>
                <input type="text" name="name" id="name" required
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-gray-300">メールアドレス</label>
                <input type="email" name="email" id="email" required
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-gray-300">パスワード</label>
                <input type="password" name="password" id="password" required
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-300">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="border border-gray-600 bg-gray-700 text-white px-4 py-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="btn-primary w-full">登録</button>
        </form>

        <p class="mt-4 text-center">
            既にアカウントをお持ちの場合は、
            <a href="{{ route('login') }}" class="text-blue-400 hover:underline">ログイン</a>
            してください。
        </p>

        <div class="mt-4 text-center">
            <a href="{{ url()->previous() ?: route('blogs.index') }}" class="btn-secondary">戻る</a>
        </div>
    </div>
@endsection
