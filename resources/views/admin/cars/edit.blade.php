@extends('admin.Adminlayout.layout')

@section('title', 'Edit Car')

@section('content')
<h3>Edit Car</h3>

<form method="POST" action="{{ route('admin.cars.update', $car) }}">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label>Title</label>
    <input name="title" value="{{ $car->title }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" value="{{ $car->price }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Mileage</label>
    <input type="number" name="mileage" value="{{ $car->mileage }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Image URL</label>
    <input name="image_url" value="{{ $car->image_url }}" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
