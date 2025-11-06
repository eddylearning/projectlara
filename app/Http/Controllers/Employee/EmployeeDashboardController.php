<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $activeTrips = Booking::where('status', 'active')->count();
        $completedTrips = Booking::where('status', 'completed')->count();
        $recentBookings = Booking::latest()->take(5)->get();

        return view('employee.EmployeeDashboard', compact(
            'totalBookings', 'activeTrips', 'completedTrips', 'recentBookings'
        ));
    }
}
