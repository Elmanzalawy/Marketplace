<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <meta name="_token" content="{{csrf_token()}}" /> --}}
<title>{{config('app.name','Venture')}}</title>

{{-- loading custom css from assets --}}
<link rel="shortcut icon" href="{{ url('images/logo.png') }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/
font-awesome/4.7.0/css/font-awesome.min.css">

<!--jQuery scripts-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--Custom CSS-->
<link rel="stylesheet" href={{ asset('css/style.css') }}?<?php echo time(); ?>">
<link rel="stylesheet" href="{{ asset('css/util.css') }}?<?php echo time(); ?>">
{{-- SLICK SLIDER --}}
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>




</head>
<body>
  @include('includes.navbar')     
    @include('includes.messages')
    @yield('content')
  {{-- @include('includes.footer') --}}
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
{{-- SLICK SLIDER --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
{{-- POPTROX SCRIPTS --}}
<script src="{{ asset('js/jquery.poptrox.min.js') }}?<?php echo time(); ?>"></script>
<script src="{{ asset('js/browser.min.js') }}?<?php echo time(); ?>"></script>
<script src="{{ asset('js/breakpoints.min.js') }}?<?php echo time(); ?>"></script>
<!--custom JS-->
<script src="{{ asset('js/custom.js') }}?<?php echo time(); ?>"></script>
</body>
</html>
