@extends('layouts.app')

@section('content')
    
    <div class="py-6 bg-white">
        <article class="max-w-screen-lg mx-auto">
            <div class="text-right"> 
                @if($item->published_at) 
                    <p>Опубликовано {{ $item->published_at->format('H:i d.m.Y') }} @if($item->user) {{ $item->user->name }}@endif</p>
                @else
                    <p>Не опубликовано</p>
                @endif 
            <h1 class="">{{ $item->title }}</h1>
            </div>
            <div class="prose py-5">
                {!! $item->content !!}
            </div> 
        </article>
    </div>
@endsection