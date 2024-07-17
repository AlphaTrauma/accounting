@extends('layouts.app')

@section('head')
    <title>{{ $item->meta_title ?? $item->title }} | СчётКоннект — биржа бухгалтерских услуг</title>
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