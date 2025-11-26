@extends('admin.AdminLayout.layout')

@section('title', 'Booking Details')

@section('content')
<div class="container">
    <h3>Booking #{{ $booking->id }}</h3>

    <table class="table table-bordered">
        <tr><th>Car</th><td>{{ $booking->car->title }}</td></tr>
        <tr><th>User</th><td>{{ $booking->user->name }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($booking->status) }}</td></tr>
        <tr><th>Payment Status</th><td>{{ ucfirst($booking->payment_status) }}</td></tr>
        <tr><th>Start</th><td>{{ $booking->start_date }}</td></tr>
        <tr><th>End</th><td>{{ $booking->end_date }}</td></tr>
    </table>

    <a href="{{ route('admin.bookings.approve', $booking->id) }}" class="btn btn-success">Approve</a>
    <a href="{{ route('admin.bookings.complete', $booking->id) }}" class="btn btn-primary">Complete</a>
    <a href="{{ route('admin.bookings.cancel', $booking->id) }}" class="btn btn-danger">Cancel</a>
</div>
@endsection
