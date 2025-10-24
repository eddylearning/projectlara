{{-- @extends('frontendlayout.app')

@section('title', 'Browse Cars')

@section('content')
<section class="cars" id="cars">
  <div class="container">
    <h3>Our Car Listings</h3>
    <div class="car-grid">
      <div class="car-card">
        <img src="https://via.placeholder.com/300x180?text=Toyota+Corolla" alt="Toyota Corolla">
        <h4>2022 Toyota Corolla</h4>
        <p>$20,500 · 18,000 miles</p>
      </div>
      <div class="car-card">
        <img src="https://via.placeholder.com/300x180?text=Honda+Civic" alt="Honda Civic">
        <h4>2021 Honda Civic</h4>
        <p>$19,300 · 22,000 miles</p>
      </div>
      <div class="car-card">
        <img src="https://via.placeholder.com/300x180?text=BMW+3+Series" alt="BMW 3 Series">
        <h4>2020 BMW 3 Series</h4>
        <p>$30,990 · 30,000 miles</p>
      </div>
      <div class="car-card">
        <img src="https://images.unsplash.com/photo-1618843473927-0cb7b9efbfa3?auto=format&fit=crop&w=300&q=80" alt="red chevy camaro">
        <h4>1960 chevi camero</h4>
        <p>$50,000 . 65,000 miles</p>
      </div>
    </div>
  </div>
</section>
@endsection --}}

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
          <p>${{ number_format($car->price, 2) }} · {{ number_format($car->mileage) }} miles</p>
        </div>
      @endforeach
    </div>
     
  {{-- ✅ Pagination Links --}}
    <div class="mt-6 flex justify-center">
      {{ $cars->links('pagination::tailwind') }}
    </div>
</section>
@endsection
