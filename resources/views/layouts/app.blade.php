<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  @stack('prepend-style')

  @include('includes.style')
</head>
<body class="hold-transition login-page">

    @yield('content')

<!-- /.login-box -->

<!-- jQuery -->
@include('includes.script')
</body>
</html>
