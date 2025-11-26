@extends('user.UserLayout.layout')

@section('title', 'Create Booking')

@section('content')
<div class="container">
    <h3>Create Booking</h3>

    <form action="{{ route('user.bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="car_id">Select Car</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="">-- Select Car --</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->title }}</option>
                @endforeach
            </select>
            @error('car_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>MPesa Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="07xxxxxxxx" required>
        </div>

        <button class="btn btn-success">Continue to Payment</button>
    </form>
</div>
@endsection
