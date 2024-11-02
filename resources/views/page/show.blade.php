@extends('layouts.app')

@section('title') {{ $item->meta_title ?? $item->title }} @endsection

@section('head')
    <meta name="description" content="{{ $item->meta_description || 'Страница "'.$item->title.'"'}}">
@endsection

@section('content')
    <div class="py-6 bg-white">
        <article class="prose  max-w-screen-lg mx-auto"> 
            <h1 class="">{{ $item->title }}</h1>
            {!! $item->content !!}
        </article>
    </div>
@endsection