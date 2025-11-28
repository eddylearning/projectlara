@extends('admin.AdminLayout.layout')

@section('title', 'Booking Reports')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">📘 Booking Reports</h3>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Today's Bookings</h6>
                    <h2>{{ $todayBookings }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>This Week</h6>
                    <h2>{{ $weekBookings }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6>This Month</h6>
                    <h2>{{ $monthBookings }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h6>Total Bookings</h6>
                    <h2>{{ $totalBookings }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Charts --}}
    <div class="row mb-5">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">📈 Bookings Per Month</div>
                <div class="card-body">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">📊 Bookings by Status</div>
                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- Export Buttons --}}
    <div class="mb-3">
        <a href="{{ route('admin.bookings.export.pdf') }}" class="btn btn-danger">Download PDF</a>
        <a href="{{ route('admin.bookings.export.excel') }}" class="btn btn-success">Download Excel</a>
        <a href="{{ route('admin.bookings.export.csv') }}" class="btn btn-primary">Download CSV</a>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-header">
            All Bookings
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Car</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->car->title ?? 'N/A' }}</td>
                        <td>
                            <span class="badge 
                                @if($booking->status == 'pending') bg-warning 
                                @elseif($booking->status == 'approved') bg-success 
                                @else bg-secondary @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>KES {{ number_format($booking->amount, 2) }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            {{ $bookings->links() }}
        </div>
    </div>

</div>


{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Bookings Per Month
    const months = @json($months);
    const monthlyData = @json($monthlyBookings);

    new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Bookings',
                data: monthlyData,
                borderColor: '#2563eb',
                borderWidth: 3,
                fill: false,
                tension: 0.3
            }]
        }
    });

    // Status Chart
    const statusLabels = @json($statusLabels);
    const statusData = @json($statusData);

    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Status',
                data: statusData,
                backgroundColor: ['#facc15', '#22c55e', '#64748b']
            }]
        }
    });
</script>

@endsection
