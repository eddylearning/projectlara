@extends('employee.EmployeeLayout.layout')

@section('title', 'Create Booking')

@section('content')
<div class="container">
    <h3>New Booking (Assist Customer)</h3>

    <form action="{{ route('employee.bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Select User (Customer)</label>
            <select name="user_id" class="form-control select2" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Select Car</label>
            <select name="car_id" class="form-control" required>
                <option value="">-- Select Car --</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        {{-- <div class="mb-3">
            <label>MPesa Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="07xxxxxxxx" required>
        </div> --}}

        <button class="btn btn-success">Continue to Payment</button>
    </form>
</div>

{{-- Include Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>

@endsection
