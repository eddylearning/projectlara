{{-- @extends('admin.AdminLayout.layout')

@section('content')
<div class="container">
    <h1>User Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
</div>
@endsection --}}


@extends('user.UserLayout.layout')

@section('title', 'User Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5>My Cars</h5>
          <h3>{{ $myCars }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5>Active Bookings</h5>
          <h3>{{ $activeBookings }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5>Completed Trips</h5>
          <h3>{{ $completedTrips }}</h3>
        </div>
      </div>
    </div>
  </div>

  <h4 class="mt-5">My Recent Bookings</h4>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Car</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentBookings as $booking)
      <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->car->title }}</td>
        <td>{{ $booking->created_at->format('M d, Y') }}</td>
        <td>{{ ucfirst($booking->status) }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center text-muted">No recent bookings.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
