<h2>MPESA Payment Logs Report</h2>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Payment ID</th>
            <th>Type</th>
            <th>Status Code</th>
            <th>Status Message</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->payment_id }}</td>
            <td>{{ $log->type }}</td>
            <td>{{ $log->status_code }}</td>
            <td>{{ $log->status_message }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
