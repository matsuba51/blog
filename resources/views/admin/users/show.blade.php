@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">{{ $user->name }} の詳細</h1>
        
        <div class="mb-4">
            <p><strong>名前:</strong> {{ $user->name }}</p>
            <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
        </div>

        <!-- 戻るボタン -->
        <div class="text-center mt-6">
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">⬅️ 戻る</a>
        </div>
    </div>
@endsection
