@extends('layouts.app')

@section('css')


<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />


@error('departments')
<style>
    .department-select2>span .select2-selection--multiple {
        border-color: #ee335e !important;
    }
</style>
@enderror

@error('days')
<style>
    .days-select2>span .select2-selection--multiple {
        border-color: #ee335e !important;
    }
</style>
@enderror

@error('image')
<style>
    .dropify-wrapper {
        border-color: #ee335e !important;
    }
</style>
@enderror




@endsection

@include('components.breadcrumb',['pervPage' => __('sidebar.clinics_t') , 'currentPage' => $clinic->translate(app()->getLocale())->name])

@section('content')

<div class="row row-sm">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <form action="{{ route('clinics.update',$clinic->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('clinics.title_main_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('clinics.includes.main_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('clinics.title_general_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('clinics.includes.general_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <h4>@lang('clinics.title_owner_info')</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @include('clinics.includes.owner_section')
                </div>
            </div>
            <div class="card  box-shadow-0 ">
                <div class="card-body pt-0">
                    <button type="submit" class="btn w-25 btn-primary mt-3 mb-0">@lang('modal.btn_submit')</button>
                </div>
            </div>

        </form>
    </div>
</div>

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>

@include('components.select_multi')
<script>
      $('#check_edit').change(function (e) { 
        $('#image_uploade').toggleClass('d-none');
        
    });
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