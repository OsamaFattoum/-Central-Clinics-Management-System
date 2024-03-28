<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@include('layouts._head')
	</head>
	
	<body class="main-body bg-primary-transparent">
		<!-- Loader -->
		@include('components.loader')
		<!-- /Loader -->
		@yield('content')		
		@include('layouts._footer-scripts')	
	</body>
</html>