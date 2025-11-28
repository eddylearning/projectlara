@extends('admin.AdminLayout.layout')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Log Entry #{{ $log->id }}</h3>

    <p><strong>Type:</strong> {{ $log->type }}</p>
    <p><strong>Status Code:</strong> {{ $log->status_code }}</p>
    <p><strong>Status Message:</strong> {{ $log->status_message }}</p>
    <p><strong>Created At:</strong> {{ $log->created_at }}</p>

    <hr>

    <h5>Raw Request</h5>
    <pre>{{ json_encode($log->raw_request, JSON_PRETTY_PRINT) }}</pre>

    <h5>Raw Response</h5>
    <pre>{{ json_encode($log->raw_response, JSON_PRETTY_PRINT) }}</pre>

</div>
@endsection
