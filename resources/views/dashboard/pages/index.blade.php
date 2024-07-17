@extends('layouts.dashboard')

@section('content')
    <h1>Все дополнительные страницы</h1>
    <div class="py-3"><a href="{{ route('page.edit') }}" class="btn btn-active">Добавить</a></div>
    <section class="py-5">
        @forelse($items as $item)
            <div class="p-3 shadow-sm bg-white mb-3 relative">
                <div class="absolute right-0 top-0 flex gap-1"> 
                    
                    <a href="{{ route('page.edit', $item->id) }}" title="Редактировать страницу" class="btn-sm"><i class="fa fa-pen"></i></a>
                    <a href="{{ route('page.remove', $item) }}" title="Удалить страницу" class="btn-sm"><i class="fa fa-trash"></i></a>
                </div>
               <a href="{{ route('page', $item->slug) }}" class="link"> {{ $item->title }} </a> 

               
            </div>
        @empty
            <p>Страниц пока нет. <a href="{{ route('page.edit') }}" class="link">Создать</a></p>
        @endforelse
    </section>
@endsection
