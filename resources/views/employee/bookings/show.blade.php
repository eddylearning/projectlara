@extends('employee.EmployeeLayout.layout')

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

    <form method="POST" action="{{ route('employee.bookings.update', $booking->id) }}">
        @csrf
        @method('PATCH')

        <label>Update Status</label>
        <select name="status" class="form-control mb-3">
            <option value="pending" @selected($booking->status=='pending')>Pending</option>
            <option value="approved" @selected($booking->status=='approved')>Approved</option>
            <option value="completed" @selected($booking->status=='completed')>Completed</option>
            <option value="cancelled" @selected($booking->status=='cancelled')>Cancelled</option>
        </select>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
