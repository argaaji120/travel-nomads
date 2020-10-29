<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title','Nomads')</title>

  @include('includes.frontend.style')

</head>

<body>
  @include('includes.frontend.navbar')

  @yield('header')

  <main>
    @yield('content')
  </main>

  @include('includes.frontend.footer')


  @include('includes.frontend.script')

</body>

</html>