<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <button class="navbar-toggler sideMenuToggler" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">

    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      <!-- @guest -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
      </li>
      <!-- @if (Route::has('register')) -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Register</a>
      </li>
      <!-- @endif
      @else -->
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          Username <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" id="navbarDropdown" data-toggle="modal" data-target="#logoutModal">
            Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            <!-- @csrf -->
          </form>
        </div>
      </li>
      <!-- @endguest -->
    </ul>
  </div>
</nav>