<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HealthService;
use App\Models\Information;
use App\Models\PublicMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_info' => Information::count(),
            'published_info' => Information::where('status', 'published')->count(),
            'draft_info' => Information::where('status', 'draft')->count(),
            'total_views' => Information::sum('views'),
            'total_categories' => Category::count(),
            'total_services' => HealthService::count(),
            'unread_messages' => PublicMessage::where('status', 'unread')->count(),
            'total_messages' => PublicMessage::count(),
        ];

        // 5 Informasi Terkini
        $latestInformations = Information::with('category')
            ->latest()
            ->take(5)
            ->get();

        // 5 Pesan Publik Terkini
        $latestMessages = PublicMessage::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestInformations', 'latestMessages'));
    }
}

