@extends('user.UserLayout.layout')

@section('title', 'Create Booking')

@section('content')
<div class="container">
    <h3>New Booking</h3>

    <form action="{{ route('user.bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="car_id" class="form-label">Select Car</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="">-- Select Car --</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->title }}</option>
                @endforeach
            </select>
            @error('car_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
            @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Book Now</button>
    </form>
</div>
@endsection
