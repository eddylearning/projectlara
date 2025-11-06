<?php

namespace App\Http\Controllers\User;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //   $Cars = Car::count();                // integer
        // $activeBookings = 0;                 // placeholder
        // $completedTrips = 0;                 // placeholder
        // $recentBookings = [];                // placeholder array

         $Cars = Car::count();
    $activeBookings = Booking::where('status', 'active')->count();
    $completedTrips = Booking::where('status', 'completed')->count();
    $recentBookings = Booking::latest()->take(5)->get();

        return view('user.UserDashboard', compact(
            'Cars',
            'activeBookings',
            'completedTrips',
            'recentBookings'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
