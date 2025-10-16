 {{-- resources/views/contact.blade.php --}}

@extends('frontendlayout.app')


@section('title', 'Contact')

@section('content')

<div class="contact-form">
    <h1>Contact Us</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

@endsection
