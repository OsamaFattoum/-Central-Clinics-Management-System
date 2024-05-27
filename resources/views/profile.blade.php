@extends('layouts.app')

@section('css')

@if (Auth::guard('clinic')->check() || Auth::guard('pharmacy')->check())	
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@error('days')
<style>
	.days-select2>span .select2-selection--multiple {
		border-color: #ee335e !important;
	}
</style>
@enderror
@endif

<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />


@endsection


@include('components.messages_alert')

@include($guardName . '.profile.index')

@section('js')

<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>


<script>
	$('.dropify').dropify({
	messages: {
		'default': "{{ __('file_upload.default') }}",
		'replace': '{{__("file_upload.replace")}}',
		'remove': '{{__("file_upload.remove")}}',
		'error': '{{__("file_upload.error")}}'
	},
	error: {
		'fileSize': '{{__("file_upload.fileSize")}}'
	}
});
</script>

@if (Auth::guard('clinic')->check() || Auth::guard('pharmacy')->check())	
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@include('components.select_multi')

@endif


@endsection