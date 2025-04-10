@extends('layouts.app')

@section('content')
    <div class="max-w-full sm:max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg share">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">ユーザー情報編集</h1>

        <!-- ユーザー情報編集フォーム -->
        <form action="{{ route('dashboard.update') }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex flex-wrap gap-4 mt-4">
                <button type="submit"
                    class="py-3 px-5 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    更新する
                </button>

                <a href="{{ route('blogs.index') }}"
                    class="py-3 px-5 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 inline-flex items-center">
                    ブログ一覧に戻る
                </a>
            </div>
        </form>

        <form action="{{ route('user.destroy', Auth::id()) }}" method="POST" onsubmit="return confirm('本当にアカウントを削除しますか？')" class="inline-block mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="py-3 px-5 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                アカウントを削除
            </button>
        </form>
    </div>
@endsection
