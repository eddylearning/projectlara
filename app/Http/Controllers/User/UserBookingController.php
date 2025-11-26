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
     * List all bookings for the logged-in user.
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
     * Show booking form.
     */
    public function create()
    {
        $cars = Car::where('available', true)->get();
        return view('bookings.create', compact('cars'));
    }

    /**
     * Store the booking – NO phone number here.
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
            'status' => Booking::STATUS_PENDING,
            'payment_status' => 'pending',
        ]);

        // Mark car unavailable
        Car::find($validated['car_id'])->update(['available' => false]);

        // Redirect user to payment page
        return redirect()->route('payment.checkout', $booking->id);
    }

       public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Cancel booking
     */
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => Booking::STATUS_CANCELLED]);
        $booking->car->update(['available' => true]);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
