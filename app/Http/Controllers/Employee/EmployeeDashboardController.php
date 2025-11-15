<?php

namespace App\Http\Controllers\Employee;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeDashboardController extends Controller
{
    /**
     * Display the employee dashboard.
     */
    public function index()
    {
        $totalBookings = Booking::count();
        $activeTrips = Booking::where('status', 'active')->count();
        $completedTrips = Booking::where('status', 'completed')->count();
        $recentBookings = Booking::latest()->take(5)->get();

        return view('employee.EmployeeDashboard', compact(
            'totalBookings',
            'activeTrips',
            'completedTrips',
            'recentBookings'
        ));
    }
}
