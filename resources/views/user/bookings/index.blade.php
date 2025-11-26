@extends('user.UserLayout.layout')

@section('title', 'My Bookings')

@section('content')
<div class="container">
    <h3>My Bookings</h3>

    <a href="{{ route('user.bookings.create') }}" class="btn btn-primary mb-3">Book a Car</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Car</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                {{-- @include('bookings._partials._bookingrow') --}}
                @include('bookings.bookingrow')

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No bookings yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
