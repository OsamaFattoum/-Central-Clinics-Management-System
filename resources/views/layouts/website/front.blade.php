<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.website._head')
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <img src="{{ URL::asset('assets/website/images/favicon.png') }}" alt="favicon" width="200px"
                class="img-fluid">
        </div>
    </div>
    <div class="content">
        @include('layouts.website._navbar')
        @yield('content')
    </div>
    @include('layouts.website._footer')
    @include('layouts.website._footer-script')
</body>

</html>