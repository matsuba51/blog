@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">新規ユーザー作成</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-2">名前</label>
                <input type="text" name="name" id="name" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">メールアドレス</label>
                <input type="email" name="email" id="email" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">パスワード</label>
                <input type="password" name="password" id="password" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="flex justify-between space-x-4">
                <button type="submit" class="btn-primary w-full py-3">
                    作成
                </button>

                <!-- 戻るボタン -->
                <a href="{{ route('admin.users.index') }}" class="btn-secondary w-full py-3">
                    戻る
                </a>
            </div>
        </form>
    </div>
@endsection
