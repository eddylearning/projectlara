@extends('layouts.app')

@section('content')
<div class="container text-center" style="max-width: 600px">

    <div class="alert alert-danger mt-4">
        <h3 class="fw-bold">Payment Failed</h3>
        <p>Unfortunately, your payment could not be completed.</p>
    </div>

    <div class="card mt-3 mb-4">
        <div class="card-body">
            <h5>Booking #{{ $booking->id }}</h5>
            <p><strong>Car:</strong> {{ $booking->car->title }}</p>
            <p><strong>Amount:</strong> 
                <span class="fw-bold">KES {{ number_format($booking->total_amount, 2) }}</span>
            </p>
        </div>
    </div>

    <a href="{{ route('payment.checkout', $booking->id) }}" class="btn btn-warning">
        Try Again
    </a>
</div>
@endsection
