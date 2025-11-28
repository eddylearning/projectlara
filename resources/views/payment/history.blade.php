@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Payments</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Receipt</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $pay)
            <tr>
                <td>{{ $pay->booking->car->title }}</td>
                <td>KES {{ number_format($pay->amount, 2) }}</td>
                <td>{{ ucfirst($pay->status) }}</td>
                <td>{{ $pay->mpesa_receipt ?? '—' }}</td>
                <td>{{ $pay->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
