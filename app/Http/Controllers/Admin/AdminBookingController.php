<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => Booking::STATUS_APPROVED]);
        return back()->with('success', 'Booking approved.');
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => Booking::STATUS_COMPLETED]);
        $booking->car->update(['available' => true]);
        return back()->with('success', 'Booking completed.');
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => Booking::STATUS_CANCELLED]);
        $booking->car->update(['available' => true]);
        return back()->with('success', 'Booking cancelled.');
    }
}
