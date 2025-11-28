<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\MpesaService;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required|string',
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        // Load booking with car
        $booking = Booking::with('car')->findOrFail($request->booking_id);

        // Calculate days
        $booking->days = $booking->calculateDays();

        // Calculate total amount
        $booking->total_amount = $booking->calculateTotalAmount();

        // Save booking
        $booking->save();

        // Create Payment
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount'     => $booking->total_amount,
            'status'     => 'pending',
            'phone'      => $request->phone,
            'method'     => 'mpesa',
        ]);

        // Initiate STK push
        $mpesa = new MpesaService();
        $response = $mpesa->stkPush($payment, $request->phone, $payment->amount);

        if (!$response) {
            return back()->with('error', 'MPESA request failed. Check logs for details.');
        }

        // Return payment status view
        return view('admin.payments.status', compact('payment'));
    }

      public function checkout($booking_id)
    {
        $booking = Booking::with('car')->findOrFail($booking_id);

        return view('payment.checkout', compact('booking'));
    }
}
