 @extends('frontendlayout.app')

@section('title', 'Welcome')

@section('content')
<section class="hero">
  <div class="container">
    <h2>Find Your Dream Car</h2>
    <p>Browse thousands of listings, filter by your needs, and drive away happy.</p>
    <div class="search-bar">
      <input type="text" placeholder="Search by make, model, or keyword">
      <button>Search</button>
    </div>
  </div>
</section>
@endsection
