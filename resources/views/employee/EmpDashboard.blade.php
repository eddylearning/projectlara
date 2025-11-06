{{-- @extends('admin.AdminLayout.layout')

@section('content')
<div class="container">
    <h1>Employee Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
</div>
@endsection --}}


@extends('employee.EmployeeLayout.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5>Total Bookings</h5>
          <h3>{{ $totalBookings }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5>Active Trips</h5>
          <h3>{{ $activeTrips }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5>Completed Trips</h5>
          <h3>{{ $completedTrips }}</h3>
        </div>
      </div>
    </div>
  </div>

  <h4 class="mt-5">Recent Bookings</h4>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Car</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentBookings as $booking)
      <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->user->name ?? 'N/A' }}</td>
        <td>{{ $booking->car->title ?? 'N/A' }}</td>
        <td>{{ ucfirst($booking->status) }}</td>
        <td>{{ $booking->created_at->format('M d, Y') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center text-muted">No recent bookings.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
