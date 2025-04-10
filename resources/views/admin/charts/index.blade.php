@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg charts">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">日ごとの投稿数</h1>

        <!-- グラフ表示 -->
        <div class="chart-container">
            <canvas id="chartCanvas" data-chart='@json($chartData)' style="height: 400px; width: 100%;"></canvas>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                管理画面に戻る
            </a>
        </div>
    </div>
@endsection
