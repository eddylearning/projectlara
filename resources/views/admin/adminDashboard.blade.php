{{-- @extends('admin.AdminLayout.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5>Total Cars</h5>
          <h3>{{ $totalCars }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5>Total Users</h5>
          <h3>{{ $totalUsers }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5>Reports</h5>
          <h3>{{ $totalReports }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5>Pending Tasks</h5>
          <h3>8</h3>
        </div>
      </div>
    </div>
  </div>

  <h4 class="mt-5">Recent Cars</h4>
  <table class="table table-striped mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Mileage</th>
      </tr>
    </thead>
    <tbody>
      @foreach($recentCars as $car)
      <tr>
        <td>{{ $car->id }}</td>
        <td>{{ $car->title }}</td>
        <td>${{ number_format($car->price, 2) }}</td>
        <td>{{ number_format($car->mileage) }} miles</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection --}}

@extends('admin.AdminLayout.layout')


@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Welcome to the Admin Dashboard 🎉</h1>
        <p>This is your admin overview page.</p>
    </div>
@endsection
