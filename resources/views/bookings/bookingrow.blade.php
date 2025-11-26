<tr>
    <td>{{ $booking->id }}</td>
    <td>{{ $booking->car->title }}</td>
    <td>{{ $booking->user->name }}</td>
    <td>{{ ucfirst($booking->status) }}</td>

    <td>
        <span class="badge 
            @if($booking->payment_status=='success') bg-success 
            @elseif($booking->payment_status=='pending') bg-warning 
            @elseif($booking->payment_status=='failed') bg-danger 
            @else bg-secondary @endif
        ">
            {{ ucfirst($booking->payment_status) }}
        </span>
    </td>

    <td>
        <a href="{{ route(Auth::user()->role.'.bookings.show', $booking->id) }}"
           class="btn btn-sm btn-info">View</a>

        @if(Auth::user()->role == 'user' && in_array($booking->payment_status, ['unpaid','failed']))
            <a href="{{ route('payment.checkout', $booking->id) }}"
               class="btn btn-sm btn-success">Pay</a>
        @endif
    </td>
</tr>
