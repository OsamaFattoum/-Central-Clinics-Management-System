@extends('layouts.app')

@section('css')
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
@endsection