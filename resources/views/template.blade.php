<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE-Edge">

	<title>@yield('title')</title>

	<link rel="stylesheet" href="/css/richtext.min.css">
	
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/profile.css">
	<link rel="stylesheet" type="text/css" href="/css/forum.css">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('src/richtext.min.css') }}">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css"/>


	<link href="https://fonts.googleapis.com/css?family=Crimson+Text|Playfair+Display" rel="stylesheet">


	@include('partials.header')

</head>
<body>

	@include('partials.nav')

	<div class="container">
		@yield('content')
	</div>

	{{-- <script type="text/javascript" src="/src/tinymce/js/tinymce/tinymce.min.js"></script> --}}
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('src/jquery.richtext.min.js') }}"></script>
	<script type="text/javascript" src="/js/forum.js"></script>
	<script type="text/javascript" src="/js/script.js"></script>

	@include('partials.footer')
</body>
</html>