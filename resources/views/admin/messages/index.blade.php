@extends('admin.AdminLayout.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="container">
    <h2 class="mb-4">Contact Messages</h2>

    @if($messages->isEmpty())
        <p>No messages found.</p>
    @else
        <div class="messages-grid">
            @foreach($messages as $message)
                <div class="message-card">
                    <div class="message-header">
                        <strong>{{ $message->name }}</strong> &lt;{{ $message->email }}&gt;
                        <span class="message-date">{{ $message->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="message-body">
                        {{ Str::limit($message->message, 150) }}
                    </div>
                    <div class="message-footer">
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-view">View</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .container { padding: 20px; }
    .messages-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
    .message-card { border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .message-header { display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 10px; }
    .message-body { font-size: 15px; color: #333; margin-bottom: 10px; }
    .message-footer { text-align: right; }
    .btn-view { text-decoration: none; color: #fff; background: #4CAF50; padding: 5px 12px; border-radius: 4px; font-size: 13px; }
    .btn-view:hover { background: #45a049; }
</style>
@endsection
