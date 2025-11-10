@extends('employee.EmployeeLayout.layout')

@section('title', 'Edit Booking Status')

@section('content')
<div class="container">
    <h3>Edit Booking #{{ $booking->id }}</h3>

    <form action="{{ route('employee.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="status">Booking Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" @if($booking->status=='pending') selected @endif>Pending</option>
                <option value="active" @if($booking->status=='active') selected @endif>Active</option>
                <option value="completed" @if($booking->status=='completed') selected @endif>Completed</option>
                <option value="cancelled" @if($booking->status=='cancelled') selected @endif>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
</div>
@endsection
