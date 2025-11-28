@extends('admin.AdminLayout.layout')

@section('title', 'All Bookings')

@section('content')
<div class="container">
    <h3>All Bookings</h3>

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
    @include('admin.bookings.partials._booking_row')
@empty
    <tr>
        <td colspan="6" class="text-center">No bookings found</td>
    </tr>
@endforelse

        </tbody>
    </table>
</div>
@endsection
