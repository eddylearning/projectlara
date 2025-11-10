@extends(Auth::user()->role == 'employee' ? 'employee.EmployeeLayout.layout' : 'user.UserLayout.layout')

@section('content')
<div class="container-fluid">
  <h3>Bookings</h3>

  @if(Auth::user()->role == 'user')
    <a href="{{ route('user.bookings.create') }}" class="btn btn-primary mb-3">Book a Car</a>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Car</th>
        <th>User</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bookings as $booking)
     @forelse($bookings as $booking)
    @include('bookings._partials._booking_row', ['booking' => $booking])
@empty
<tr>
    <td colspan="7" class="text-center text-muted">No bookings found.</td>
</tr>
@endforelse

      @endforeach
    </tbody>
  </table>
</div>
@endsection
