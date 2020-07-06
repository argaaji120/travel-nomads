<div class="container">
  <nav class="row navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/frontend/images/logo/logo-nomads.png') }}" alt="Nomads" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item active mx-md-2">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item mx-md-2">
          <a class="nav-link" href="#">Paket Travel</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Services
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Link 1</a>
            <a class="dropdown-item" href="#">Link 2</a>
            <a class="dropdown-item" href="#">Link 3</a>
          </div>
        </li>
        <li class="nav-item mx-md-2">
          <a class="nav-link" href="#">Testimonial</a>
        </li>
      </ul>
      <!-- Mobile button -->
      <form class="form-inline d-sm-block d-md-none">
        <button class="btn btn-login my-2 my-sm-0">
          Masuk
        </button>
      </form>
      <!-- Desktop Button -->
      <form class="form-inline my-2 my-lg-0 d-none d-md-block">
        <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
          Masuk
        </button>
      </form>
    </div>
  </nav>
</div>