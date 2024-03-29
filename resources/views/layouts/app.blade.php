<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@include('layouts._head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		@include('components.loader')
		<!-- /Loader -->
		@include('layouts._main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts._main-header')			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
            	@include('layouts._footer')
				@include('layouts._footer-scripts')	
	</body>
</html>