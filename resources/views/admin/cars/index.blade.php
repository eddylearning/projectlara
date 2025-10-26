@extends('admin.AdminLayout.layout')

@section('title', 'Cars')

@section('content')
<div class="container">
  <h1>Cars</h1>
  <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-3">+ Add Car</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Mileage</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cars as $car)
      <tr>
        <td>{{ $car->id }}</td>
        <td>{{ $car->title }}</td>
        <td>${{ number_format($car->price, 2) }}</td>
        <td>{{ number_format($car->mileage) }}</td>
        <td>
          <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this car?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
