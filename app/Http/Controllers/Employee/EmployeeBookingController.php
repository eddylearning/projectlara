<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car'])->latest()->get();

        return view('employee.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $cars = Car::where('available', true)->get();

        return view('employee.bookings.create', compact('users', 'cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id'  => 'required|exists:cars,id',
            'start_date' => 'required|date|after:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $booking = Booking::create($validated + [
            'status' => 'pending'
        ]);

        // Make car unavailable
        Car::where('id', $request->car_id)->update(['available' => false]);

        // Redirect to payment
        return redirect()->route('payment.checkout', $booking->id);
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated.');
    }
}
