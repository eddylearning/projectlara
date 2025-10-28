<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      background: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      background-color: #1f2937;
      color: #fff;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
    }
    .sidebar a {
      color: #cbd5e1;
      text-decoration: none;
      padding: 12px 20px;
      display: block;
      transition: 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #374151;
      color: #fff;
    }
    .sidebar h4 {
      text-align: center;
      padding: 1rem 0;
      border-bottom: 1px solid #374151;
    }
    .main-content {
      margin-left: 250px;
      flex: 1;
      padding: 2rem;
    }
    .navbar {
      position: fixed;
      top: 0;
      left: 250px;
      right: 0;
      z-index: 1000;
      background: #111827;
      color: #fff;
      padding: 1rem 1.5rem;
    }
    .content-wrapper {
      margin-top: 60px;
    }
  </style>
</head>
<body>

  {{-- Sidebar --}}
  <div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">🏠 Dashboard</a>
    <a href="{{ route('admin.cars.index') }}" class="{{ request()->is('admin/cars*') ? 'active' : '' }}">🚗 Cars</a>
    <a href="{{route('admin.reports.index')}}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}">📊 Reports</a>
    <a href="#" class="{{ request()->is('admin/users*') ? 'active' : '' }}">👤 Users</a>
    <a href="#" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">⚙️ Settings</a>
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="mt-auto">🚪 Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>

  {{-- Top Navbar --}}
  <div class="navbar">
    <h5 class="m-0">@yield('title')</h5>
  </div>

  {{-- Main Content --}}
  <div class="main-content">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
