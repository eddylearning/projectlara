<!-- Header -->
<header class="header">
  <div class="container nav-container">
    <div class="logo">CarSelect</div>
    <nav>
    <ul class="nav-links">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('about') }}">About</a></li>
    <li><a href="{{ route('cars') }}">Cars</a></li>
    <li><a href="{{ route('welcome') }}">Welcome</a></li>
    <li><a href="{{ route('contact') }}">Contact</a></li>

    @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        @if (Route::has('register'))
            <li><a href="{{ route('register') }}">Register</a></li>
        @endif
    @else
        <li class="dropdown">
            <a href="#" class="dropbtn">{{ Auth::user()->name }}</a>
            <ul class="dropdown-content">
                <li><a href="{{ route('redirect.dashboard') }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    @endguest
</ul>

    </nav>
  </div>
</header>
