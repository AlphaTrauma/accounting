@extends('layouts.dashboard')

@section('content')
    <h1>Все статьи</h1>

    <section>
        @forelse($items as $item)
            <div class="p-3 shadow-sm">
                {{ $item->title }} {{ $item->user->name }}
            </div>
        @empty
            <p>Статей пока нет. <a href="{{ route('articles.edit') }}" class="link">Создать</a></p>
        @endforelse
    </section>
@endsection
