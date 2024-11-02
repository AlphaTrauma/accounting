@extends('layouts.app')

@section('title')
Главная
@endsection

@section('wide-content') 
    <slider-main>
        @include('blocks.slider_placeholder')
    </slider-main>
    @include('blocks.main_second')
@endsection
