@extends('user.UserLayout.layout')

@section('title', 'Booking Details')

@section('content')
<div class="container">
    <h3>Booking #{{ $booking->id }}</h3>

    <table class="table table-bordered">
        <tr><th>Car</th><td>{{ $booking->car->title }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($booking->status) }}</td></tr>
        <tr><th>Payment Status</th><td>{{ ucfirst($booking->payment_status) }}</td></tr>
        <tr><th>Start Date</th><td>{{ $booking->start_date }}</td></tr>
        <tr><th>End Date</th><td>{{ $booking->end_date }}</td></tr>
    </table>

    @if($booking->payment_status === 'unpaid' || $booking->payment_status === 'failed')
        <a href="{{ route('payment.checkout', $booking->id) }}" class="btn btn-success">Pay Now</a>
    @endif
</div>
@endsection
