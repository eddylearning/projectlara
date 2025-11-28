<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Example dashboard data
        $totalCars = Car::count();
        $totalUsers = User::count();
        $totalReports = 0; // Placeholder — if you add a Report model later
        $messageCount = ContactMessage::count();

        $recentCars = Car::latest()->take(5)->get();

        return view('admin.AdminDashboard', compact(
            'totalCars',
            'totalUsers',
            'totalReports',
            'recentCars',
            'messageCount'
            
        ));
    }
}
