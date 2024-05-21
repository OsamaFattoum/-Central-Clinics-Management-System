@extends('layouts.app')



@include($guardName . '.index')

@section('js')
    @stack('charts')
@endsection