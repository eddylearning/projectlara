@extends('admin.FrontendLayout')

@section('title', 'Add Car')

@section('content')
<h3>Add New Car</h3>

<form method="POST" action="{{ route('admin.cars.store') }}">
  @csrf

  <div class="mb-3">
    <label>Title</label>
    <input name="title" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Mileage</label>
    <input type="number" name="mileage" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Image URL</label>
    <input name="image_url" class="form-control">
  </div>

  <button class="btn btn-success">Save</button>
</form>
@endsection
