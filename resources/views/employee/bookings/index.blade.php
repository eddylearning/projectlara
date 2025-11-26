@extends('employee.EmployeeLayout.layout')

@section('title', 'Bookings')

@section('content')
<div class="container">
    <h3>All Bookings</h3>

    <a href="{{ route('employee.bookings.create') }}" class="btn btn-primary mb-3">Create Booking</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Car</th>
                <th>User</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @forelse($bookings as $booking)
            {{-- @include('bookings._partials._booking_row') --}}
            @include('bookings.bookingrow')

        @empty
            <tr>
                <td colspan="6" class="text-center">No bookings found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
