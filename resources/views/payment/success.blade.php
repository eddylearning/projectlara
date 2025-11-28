@extends('layouts.app')

@section('content')
<div class="container text-center" style="max-width: 600px">

    <div class="alert alert-success mt-4">
        <h3 class="fw-bold">Payment Successful</h3>
        <p>Your payment has been received.</p>
    </div>

    <div class="card mt-3 mb-4">
        <div class="card-body">
            <h5>Booking #{{ $booking->id }}</h5>
            <p><strong>Car:</strong> {{ $booking->car->title }}</p>
            <p><strong>Total Paid:</strong> 
                <span class="text-success fw-bold">KES {{ number_format($booking->total_amount, 2) }}</span>
            </p>
            <p><strong>MPESA Receipt:</strong> {{ $payment->mpesa_receipt }}</p>
        </div>
    </div>

    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary">
        View Booking
    </a>
</div>
@endsection
