@extends('layouts.app')

@section('css')
@endsection

@if ($guardName == 'admin')
	@include('admin.index')
@endif

@section('js')
@endsection