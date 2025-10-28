@extends('admin.AdminLayout.layout')

@section('title', 'Reports')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reports</h2>
        <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">➕ Add Report</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Car</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->title }}</td>
                <td>{{ $report->car?->title }}</td>
                <td>{{ Str::limit($report->description, 50) }}</td>
                <td>
                    <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                    <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this report?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No reports yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $reports->links() }}
</div>
@endsection
