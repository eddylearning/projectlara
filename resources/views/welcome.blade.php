 @extends('frontendlayout.app')

@section('title', 'Welcome')

@section('content')
<section class="hero">
  <div class="container">
    <h2>Find Your Dream Car</h2>
    <p>Browse thousands of listings, filter by your needs, and drive away happy.</p>
    {{-- <div class="search-bar">
    <form action="{{ route('cars') }}" method="GET">
        <input 
            type="text" 
            name="search" 
            placeholder="Search by make, model, or keyword"
            value="{{ request('search') }}"
        >
        <button type="submit">Search</button>
    </form>
</div> --}}

  </div>
</section>
@endsection
