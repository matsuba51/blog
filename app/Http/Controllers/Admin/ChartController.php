<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // 日ごとの投稿数を取得（日付のフォーマットも指定）
        $data = Blog::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))  // GROUP BY を使って日ごとに集計
            ->orderBy('date', 'asc')  // 日付順に並べる
            ->get();

        // Chart.js 用のデータを作成
        $chartData = [
            'labels' => $data->pluck('date')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d'); // 日付を 'Y-m-d' 形式にフォーマット
            })->toArray(),  // labels: 日付データ
            'datasets' => [
                [
                    'label' => '投稿数',
                    'data' => $data->pluck('count')->toArray(),  
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)', 
                    'borderColor' => 'rgba(54, 162, 235, 1)',  
                    'borderWidth' => 2,  
                    'pointRadius' => 5,  
                    'fill' => true,  
                ]
            ]
        ];

        // dd($data);

        return view('admin.charts.index', compact('chartData'));
    }
}
