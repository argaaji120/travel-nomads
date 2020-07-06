<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Nomads')</title>

  @include('includes.frontend.style')

</head>

<body>
  @include('includes.frontend.navbar-alternate')

  @yield('header')

  <main>
    @yield('content')
  </main>

  @include('includes.frontend.footer')

  @stack('before-script')
  @include('includes.frontend.script')
  @stack('after-script')
</body>

</html>