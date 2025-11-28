@extends('admin.AdminLayout.layout')

@section('content')
<div class="container">
    <h2>All Payments</h2>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Car</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Receipt</th>
                <th>Transaction ID</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payments as $pay)
            <tr>
                <td>{{ $pay->booking->user->name }}</td>
                <td>{{ $pay->booking->car->title }}</td>
                <td>KES {{ number_format($pay->amount, 2) }}</td>
                <td>{{ ucfirst($pay->status) }}</td>
                <td>{{ $pay->mpesa_receipt ?? '—' }}</td>
                <td>{{ $pay->transaction_id }}</td>
                <td>{{ $pay->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
