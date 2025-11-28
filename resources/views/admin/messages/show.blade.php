@extends('admin.AdminLayout.layout')

@section('title', 'Message Details')

@section('content')
<div class="container">
    <h2>Message from {{ $message->name }}</h2>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Date:</strong> {{ $message->created_at->format('d M Y, H:i') }}</p>
    <hr>
    <p>{{ $message->message }}</p>
    <a href="{{ route('admin.messages.index') }}" class="btn-back">← Back to Messages</a>
</div>

<style>
    .container { padding: 20px; background: #fff; border-radius: 8px; max-width: 700px; margin: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    hr { margin: 15px 0; }
    .btn-back { text-decoration: none; color: #fff; background: #2196F3; padding: 6px 12px; border-radius: 4px; display: inline-block; margin-top: 10px; }
    .btn-back:hover { background: #1976D2; }
</style>
@endsection
