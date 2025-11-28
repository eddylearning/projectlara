@extends('admin.AdminLayout.layout')

@section('content')

<style>
    .logs-container {
        background: #ffffff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .logs-title {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .logs-table th {
        background: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
    }

    .logs-table td {
        vertical-align: middle;
    }

    .top-actions {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .search-bar {
        max-width: 250px;
    }
</style>

<div class="container mt-4 logs-container">

    <div class="top-actions">
        <h2 class="logs-title">MPESA Payment Logs</h2>

        <a href="{{ route('admin.payments.logs.pdf') }}" class="btn btn-danger">
            Download PDF
        </a>
    </div>

    <table class="table table-bordered table-striped logs-table">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Type</th>
                <th>Status Code</th>
                <th>Status Message</th>
                <th>Created At</th>
                <th>View</th>
            </tr>
        </thead>

        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->payment_id }}</td>
                <td>{{ ucfirst($log->type) }}</td>
                <td>{{ $log->status_code ?? '—' }}</td>
                <td>{{ $log->status_message ?? '—' }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('admin.payments.logs.show', $log->id) }}" 
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    No payment logs found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $logs->links() }}
    </div>
</div>

@endsection
