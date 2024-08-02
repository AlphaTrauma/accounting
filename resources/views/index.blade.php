@extends('layouts.app')

@section('head')
    <title>СчётКоннект</title>
@endsection

@section('wide-content') 
    <slider-main>
        @include('blocks.slider_placeholder')
    </slider-main>
    @include('blocks.main_second')
@endsection
