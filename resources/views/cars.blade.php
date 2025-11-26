@extends('frontendlayout.app')

@section('title', 'Browse Cars')

@section('content')
<section class="cars" id="cars">
  <div class="container">
    <h3>Our Car Listings</h3>

    <div class="car-grid">

      @foreach($cars as $car)
        <div class="car-card">
          <img src="{{ $car->image_url }}" alt="{{ $car->title }}">

          <h4>{{ $car->title }}</h4>

          {{-- Price + Mileage --}}
          <p>
            KES {{ number_format($car->price, 2) }}
            ·
            {{ number_format($car->mileage) }} km
          </p>

          {{-- Optional: Book Now Button --}}
          <a href="{{ route('user.bookings.create', $car->id) }}" class="btn">
            Book Now
          </a>
        </div>
      @endforeach

    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-center">
      {{ $cars->links('pagination::tailwind') }}
    </div>

  </div>
</section>
@endsection
