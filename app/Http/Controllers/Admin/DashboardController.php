<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $month = now()->startOfMonth();

        $stats = [
            'total' => Questionnaire::count(),
            'today' => Questionnaire::where('created_at', '>=', $today)->count(),
            'month' => Questionnaire::where('created_at', '>=', $month)->count(),
            'with_email' => Questionnaire::whereNotNull('email')->where('email', '!=', '')->count(),
        ];

        $recent = Questionnaire::latest()->limit(10)->get();

        // กราฟ 7 วันล่าสุด (เอาไปใช้ทำ chart ได้)
        $daily = Questionnaire::query()
                              ->where('created_at', '>=', now()->subDays(6)->startOfDay())
                              ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
                              ->groupBy('d')
                              ->orderBy('d')
                              ->get()
                              ->map(fn($r) => ['date' => (string)$r->d, 'count' => (int)$r->c]);

        return view('admin.dashboard', compact('stats', 'recent', 'daily'));
    }
}
