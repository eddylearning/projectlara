@extends(Auth::user()->role == 'employee' ? 'employee.EmployeeLayout.layout' : 'user.UserLayout.layout')

@section('title', 'Booking Details')

@section('content')
<div class="container">
    <h3>Booking #{{ $booking->id }}</h3>

    <table class="table table-bordered">
        <tr>
            <th>Car</th>
            <td>{{ $booking->car->title }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $booking->user->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($booking->status) }}</td>
        </tr>
        <tr>
            <th>Start Date</th>
            <td>{{ $booking->start_date->format('M d, Y') }}</td>
        </tr>
        <tr>
            <th>End Date</th>
            <td>{{ $booking->end_date->format('M d, Y') }}</td>
        </tr>
    </table>

    @if(Auth::user()->role == 'employee')
        <form action="{{ route('employee.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="status">Update Status</label>
            <select name="status" id="status" class="form-control mb-3">
                <option value="pending" @if($booking->status=='pending') selected @endif>Pending</option>
                <option value="active" @if($booking->status=='active') selected @endif>Active</option>
                <option value="completed" @if($booking->status=='completed') selected @endif>Completed</option>
                <option value="cancelled" @if($booking->status=='cancelled') selected @endif>Cancelled</option>
            </select>
            <button class="btn btn-primary">Update Status</button>
        </form>
    @endif
</div>
@endsection
