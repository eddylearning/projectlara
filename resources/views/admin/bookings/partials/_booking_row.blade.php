<tr>
    <td>{{ $booking->id }}</td>
    <td>{{ $booking->car->name ?? 'N/A' }}</td>
    <td>{{ $booking->user->name ?? 'N/A' }}</td>
    <td>{{ ucfirst($booking->status) }}</td>
    <td>{{ ucfirst($booking->payment_status) }}</td>
    <td>
        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View</a>
        {{-- <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
    </td>
</tr>
