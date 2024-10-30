@extends('layouts.dashboard')

@section('content')
    <h1>Управление гайдами</h1>
    <div class="py-5">
        <a href="{{ route('guides.create') }}" title="Добавить гайд" class="btn btn-active mb-3"><i class="fa fa-pen"></i> Добавить гайд</a>
    </div>
    <section class="flex gap-3">
        @forelse($guides as $guide)
        <div  class="block w-full max-w-[22%] p-6 pb-[80px] rounded-lg relative shadow @if(!$guide->status) bg-gray-200 @else bg-white @endif">
            
            <h5 class="mb-2 text-2xl font-bold  @if(!$guide->status) line-through text-gray-600 @else text-gray-900 @endif">{{ $guide->title }}</h5>
            <p class="font-normal text-gray-700">{{ $guide->description }}</p>
            <hr class="my-5">
            <div class="flex justify-between items-center">
                <div>
                    <b>Вложений:</b> {{ $guide->files_count }}
                </div>
                <div>
                    <span class="text-teal-600 font-bold"><span class="text-2xl">{{ number_format($guide->price, 0, '', ' ') }}</span> ₽</span>
                </div>
            </div>
            <div class="absolute bottom-1 right-1 flex gap-1 mt-5">
                
                <request-form text="Вы уверены, что хотите @if($guide->status) снять гайд с публикации @else опубликовать гайд @endif?" action="{{ route('guides.update', $guide) }}" method="POST">
                    @method('PUT')
                    @csrf
                    @if($guide->status)
                        <input type="hidden" name="status" value="0">
                        <button type="submit" title="Снять с публикации" class="btn-sm"><i class="fa-solid fa-eye-slash"></i></button>
                    @else
                        <input type="hidden" name="status" value="1">
                        <button type="submit" title="Опубликовать" class="btn-sm"><i class="fa-solid fa-eye"></i></button>
                    @endif
                </request-form>
                
            
            <a href="{{ route('guides.edit', $guide) }}" title="Редактировать гайд" class="btn-sm"><i class="fa fa-pen"></i></a>
            <request-form text="Вы уверены, что хотите удалить гайд?" action="{{ route('guides.delete', $guide) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" title="Удалить" class="btn-sm"><i class="fa fa-trash"></i></button>
            </request-form> 
        </div>
        </div>
        @empty
            <p>Гайдов пока нет. <a href="{{ route('guides.create') }}" class="link">Добавить</a></p>
        @endforelse

        <div class="py-3">
            {{ $guides->links() }}
        </div>
    </section>
@endsection