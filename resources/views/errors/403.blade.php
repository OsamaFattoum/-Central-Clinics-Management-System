@extends('layouts.guest')


@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="{{URL::asset('assets/img/media/403.png')}}" class="error-page" alt="error">
			<h2 class="mt-2">@lang('site.h_403')</h2>
			<h6>@lang('site.p_403')</h6><a class="btn btn-outline-dark" href="{{ route('welcome') }}">@lang('site.btn_back_home')</a>
		</div>
		<!-- /Main-error-wrapper -->
@endsection

