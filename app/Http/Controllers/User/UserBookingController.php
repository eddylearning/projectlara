<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    /**
     * Show all bookings belonging to the logged-in user.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
                            ->with('car')
                            ->latest()
                            ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show a form to create a new booking.
     */
    public function create()
    {
        $cars = Car::where('available', true)->get();
        return view('bookings.create', compact('cars'));
    }

    /**
     * Store a new booking in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => Booking::STATUS_PENDING, // or 'pending' if constants not used
        ]);

         // Mark car as unavailable
        $car = Car::find($validated['car_id']);
        $car->update(['available' => false]);

        return redirect()->route('booking.index')
                         ->with('success', 'Booking created successfully.');
    }

    /**
     * Cancel an existing booking.
     */
    public function destroy(Booking $booking)
    {
        // Ensure the user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        //CANLING THE BOOKING
        // Update status instead of deleting (soft cancel)
        $booking->update(['status' => Booking::STATUS_CANCELLED]);

        // Mark the car available again
        $booking->car->update(['available' => true]);
        
        return back()->with('success', 'Booking cancelled successfully.');
    }
}
