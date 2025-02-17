@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">ユーザー一覧</h1>

        <div class="flex justify-between mb-4">
            <!-- 新規ユーザー作成ボタン -->
            <a href="{{ route('admin.users.create') }}" class="btn-primary">➕ 新規ユーザー作成</a>

            <!-- 管理画面に戻るボタン -->
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary">⬅️ 管理画面に戻る</a>
        </div>

        <!-- ユーザー一覧テーブル -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-700">
                <thead>
                    <tr class="bg-gray-900 text-white">
                        <th class="p-3 border border-gray-700 text-left">名前</th>
                        <th class="p-3 border border-gray-700 text-left">メールアドレス</th>
                        <th class="p-3 border border-gray-700 text-center">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-gray-700 hover:bg-gray-600 transition">
                            <td class="p-3 border border-gray-600">{{ $user->name }}</td>
                            <td class="p-3 border border-gray-600">{{ $user->email }}</td>
                            <td class="p-3 border border-gray-600 text-center flex justify-center space-x-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn-info">👤 詳細</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">✏️ 編集</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️ 削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
