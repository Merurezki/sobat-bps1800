<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Title -->
  <title>{{ config('app.name', 'SOBAT') }}</title>

  <!-- Jquery & Bootstrap Script -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <!-- Bootstrap Style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <!-- Sidebars -->
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/" />

  <!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

  <!-- Custom Styles -->
  <style>
    .jumbotron {
      background-color: #e2edff;
    }
  </style>
</head>

<body id="home">
  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">
      <a class="navbar-brand" href="#home">SOBAT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" href="#login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <section class="jumbotron text-center" id="home">
    <img src="{{ asset('img/logo.png') }}" alt="Badan Pusat statistik" width="200" />
    <h1 class="display-4">SOBAT</h1>
    <p class="lead">Sistem Pengelolaan Barang TI</p>
  </section>
  <!-- Jumbotron end-->

  <!-- Login -->
  <section class="mb-5" id="login">
    <div class="cont text-center">
      <div class="row">
        <div class="col">
          <h2>Login</h2>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mb-3 me-3 ms-3">
      <div class="col-md-5">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="mb-3">
            <label for="username" class="form-label ml-1">{{ __('Username') }}</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label ml-1">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
          </button>
        </form>
      </div>
    </div>
  </section>
  <!-- Login end-->

  <!-- footer -->
  <footer class="bg-primary text-white text-center p-1">
    <p>Created with <i class="bi bi-suit-heart-fill text-danger"></i> by OJT Polstat STIS 59</p>
  </footer>

</body>

</html>