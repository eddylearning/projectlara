@extends('admin.AdminLayout.layout')

@section('sidebar')
<div class="sidebar">
  <h4>User Panel</h4>
  <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user') ? 'active' : '' }}">🏠 Dashboard</a>
  <a href="{{ route('user.bookings.index') }}" class="{{ request()->is('user/bookings*') ? 'active' : '' }}">📘 My Bookings</a>
  <a href="{{ route('user.cars.index') }}" class="{{ request()->is('user/cars*') ? 'active' : '' }}">🚗 My Cars</a>
  <a href="{{ route('user.profile') }}" class="{{ request()->is('user/profile*') ? 'active' : '' }}">👤 Profile</a>
  <a href="{{ route('logout') }}" 
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
     class="mt-auto">🚪 Logout</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>
@endsection
