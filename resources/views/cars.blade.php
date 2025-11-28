@extends('frontendlayout.app')

@section('title', 'Browse Cars')

@section('content')
<section class="cars" id="cars">
  <div class="container">
    <h3>Our Car Listings</h3>

  <form action="{{ route('cars') }}" method="GET" class="search-bar">
    <input 
        type="text" 
        name="search"
        placeholder="Search by make, model, or keyword"
        value="{{ request('search') }}"
    >
    <button type="submit">Search</button>
</form>

    <div class="car-grid">
      @forelse($cars as $car)
       <div class="car-card">
  <div class="car-image" style="position: relative;">
    
    {{-- Status Badge --}}
    @if(!$car->available)
      <span class="badge sold">Sold</span>
    @else
      <span class="badge available">Available</span>
    @endif

    <img src="{{ $car->image_url }}" alt="{{ $car->title }}">
  </div>

  <div class="car-info">
    <h4>{{ $car->title }}</h4>
    <p>
      KES {{ number_format($car->price, 2) }} · {{ number_format($car->mileage) }} km
    </p>
    {{-- Disable Book Now if not available --}}
    @if($car->available)
      <a href="{{ route('user.bookings.create', $car->id) }}" class="btn">
        Book Now
      </a>
    @else
      <button class="btn disabled" disabled>Book Now</button>
    @endif
  </div>
</div>


      @empty
        <p class="text-center">No cars available at the moment.</p>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($cars->hasPages())
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($cars->onFirstPage())
          <li><span>&laquo;</span></li>
        @else
          <li><a href="{{ $cars->previousPageUrl() }}">&laquo;</a></li>
        @endif

        {{-- Page Links --}}
        @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
          @if ($page == $cars->currentPage())
            <li><span class="active">{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($cars->hasMorePages())
          <li><a href="{{ $cars->nextPageUrl() }}">&raquo;</a></li>
        @else
          <li><span>&raquo;</span></li>
        @endif
      </ul>
    @endif

  </div>
</section>
@endsection
