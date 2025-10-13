 <!-- @extends('frontendlayout.app')

@section('title', 'Home')

@section('content')
<section class="container">
  <h2>Welcome to CarSelect</h2>
  <p>This is your home dashboard or landing screen for users.</p>
</section>
@endsection -->

/*the commented out code above is being displayed on browser */
@extends('frontendlayout.app')

@section('title', 'Home')

@section('content')
<section class="features">
  <div class="container">
    <h2>Welcome to CarSelect</h2>
    <p>This is your home dashboard or landing screen for users.</p>

    <div class="feature-grid">
      <div class="feature-item">
        <h4>Explore Cars</h4>
        <p>Browse thousands of cars tailored to your preferences.</p>
      </div>

      <div class="feature-item">
        <h4>Save Favorites</h4>
        <p>Bookmark listings and come back to them anytime.</p>
      </div>

      <div class="feature-item">
        <h4>Contact Sellers</h4>
        <p>Reach out to trusted sellers directly through the platform.</p>
      </div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container">
    <h3>Ready to find your next car?</h3>
    <a href="{{ route('cars') }}" class="cta-button">Browse Cars</a>
  </div>
</section>
@endsection
