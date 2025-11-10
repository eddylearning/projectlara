<tr>
    <td>{{ $booking->id }}</td>
    <td>{{ $booking->car->title }}</td>
    @if(Auth::user()->role == 'employee')
        <td>{{ $booking->user->name ?? '-' }}</td>
    @endif
    <td>{{ ucfirst($booking->status) }}</td>
    <td>{{ $booking->start_date->format('M d, Y') }}</td>
    <td>{{ $booking->end_date->format('M d, Y') }}</td>
    <td>
        @if(Auth::user()->role == 'employee')
            <a href="{{ route('employee.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
        @elseif(Auth::user()->role == 'user')
            <form action="{{ route('user.bookings.destroy', $booking->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Cancel this booking?')">Cancel</button>
            </form>
        @endif
    </td>
</tr>
