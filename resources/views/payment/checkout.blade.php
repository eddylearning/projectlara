@extends('frontendlayout.app')

@section('content')
<div class="container" style="max-width: 600px">

    <h2 class="mb-4">MPESA Payment</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Fix the following errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5><strong>Car:</strong> {{ $booking->car->title }}</h5>
            <p><strong>Days:</strong> {{ $booking->days }}</p>
            <p><strong>Total Amount:</strong> 
                <span class="text-success fw-bold">KES {{ number_format($booking->total_amount, 2) }}</span>
            </p>
        </div>
    </div>

    <div class="alert alert-info">
        <strong>Instructions:</strong><br>
        An MPESA STK push will be sent to your phone.  
        Enter MPESA PIN to complete the payment.
    </div>

    <form id="paymentForm" method="POST" action="{{ route('payment.process') }}">
        @csrf

        {{-- Hidden booking_id --}}
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div class="mb-3">
            <label for="phone" class="form-label">MPESA Phone Number (Format: 2547XXXXXXXX)</label>
            <input type="text" 
                   name="phone" 
                   id="phone"
                   class="form-control"
                   placeholder="254712345678"
                   value="{{ old('phone', auth()->user()->phone ?? '') }}"
                   required>
        </div>

        <button id="payBtn" class="btn btn-primary w-100">
            Pay with MPESA
        </button>
    </form>

    {{-- Spinner --}}
    <div id="spinner" class="text-center mt-3 d-none">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Sending MPESA STK Push...</p>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const form = document.getElementById('paymentForm');
    const payBtn = document.getElementById('payBtn');
    const spinner = document.getElementById('spinner');
