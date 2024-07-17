@extends('layouts.app')

@section('content')
    
    <div class="py-6 bg-white">
        <article class="prose  max-w-screen-lg mx-auto">
            <div class="text-right">
                @if($item->published_at) 
                <div>Опубликовано {{ $item->published_at->format('H:i d.m.Y') }} @if($item->user) {{ $item->user->name }}@endif</p>
            @else
                <div>Не опубликовано</small>
            @endif
            </div>
            <h1 class="">{{ $item->title }}</h1>
              
        
        </div>
            {!! $item->content !!}
        </article>
    </div>
@endsection