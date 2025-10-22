<!-- Header -->
<header class="header">
  <div class="container nav-container">
    <div class="logo">CarSelect</div>
    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('cars') }}">Cars</a></li>
        <li><a href="{{route('welcome')}}">welcome</a></li>
        <li><a href="{{route('contact')}}">Contact</a></li>
                <!--to handle login and register created by breeze-->
         @guest
        <li><a href="{{ route('login') }}">Login</a></li>

        @if (Route::has('register'))
            <li><a href="{{ route('register') }}">Register</a></li>
        @endif
    @else
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    Logout ({{ Auth::user()->name }})
                </button>
            </form>
        </li>
     @endguest  
      </ul>
    </nav>
  </div>
</header>


