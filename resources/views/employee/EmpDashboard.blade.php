{{-- @extends('admin.AdminLayout.layout')

@section('content')
<div class="container">
    <h1>Employee Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
</div>
@endsection --}}

@extends('employee.EmployeeLayout.layout')

@section('title', 'Employee Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5>Assigned Cars</h5>
          <h3>{{ $assignedCars }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5>Completed Reports</h5>
          <h3>{{ $completedReports }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5>Pending Reviews</h5>
          <h3>{{ $pendingReviews }}</h3>
        </div>
      </div>
    </div>
  </div>

  <h4 class="mt-5">Recent Reports</h4>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Car</th>
        <th>Report Type</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentReports as $report)
      <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->car->title }}</td>
        <td>{{ ucfirst($report->type) }}</td>
        <td>{{ $report->created_at->format('M d, Y') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center text-muted">No recent reports.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
