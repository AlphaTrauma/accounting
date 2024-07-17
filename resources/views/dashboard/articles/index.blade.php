@extends('layouts.dashboard')

@section('content')
    <h1>Все статьи</h1>
    <section>
        @forelse($items as $item)
            <div class="p-3 shadow-sm bg-white mb-3">
                <div class="float-right flex gap-1">
                    @if($item->published_at)
                        <a href="" title="Снять с публикации" class="btn-sm"><i class="fa-solid fa-eye-slash"></i></a>
                    @else
                        <a href="" title="Опубликовать" class="btn-sm"><i class="fa-solid fa-eye"></i></a>
                    @endif
                    
                    <a href="{{ route('article.edit', $item->id) }}" title="Редактировать статью" class="btn-sm"><i class="fa fa-pen"></i></a>
                    <a href="{{ route('article.remove', $item) }}" title="Удалить статью" class="btn-sm"><i class="fa fa-trash"></i></a>
                </div>
               <a href="{{ $item->slug ? route('article.show', $item->slug) : route('article.show', $item->id)}}" class="link"> {{ $item->title }} </a> 
               <p>Автор: <b>{{ $item->user->name }}</b></p>
               
            </div>
        @empty
            <p>Статей пока нет. <a href="{{ route('articles.edit') }}" class="link">Создать</a></p>
        @endforelse
    </section>
@endsection
