<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show create booking page.
     */
    public function create(Car $car)
    {
        return view('bookings.create', compact('car'));
    }

    /**
     * Store booking and redirect to payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Calculate days
        $start  = Carbon::parse($request->start_date);
        $end    = Carbon::parse($request->end_date);
        $days   = $start->diffInDays($end);

        if ($days < 1) {
            return back()->withErrors(['end_date' => 'End date must be at least 1 day after start date']);
        }

        // Calculate total price: daily price × number of days
        $total_amount = $car->price_per_day * $days;

        // Create booking
        $booking = Booking::create([
            'user_id'   => Auth::id(),
            'car_id'    => $car->id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'days'       => $days,
            'total_amount' => $total_amount,
            'payment_status' => 'pending', // NOT PAID YET
        ]);

        // Redirect to payment page
        return redirect()->route('payment.checkout', $booking->id)
            ->with('success', 'Booking created. Please complete payment.');
    }

    /**
     * List logged-in user bookings
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show one booking
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }
}
