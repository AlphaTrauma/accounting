@extends('layouts.app')

@section('head')
    <title>Оплата гайда | СчётКоннект — биржа бухгалтерских услуг</title>
@endsection

@section('content')
    <div class="py-6 bg-white">
        <div class="p-3">
            <h1>Оплата товара</h1>
        </div>
        <div class="p-3">
            <p>Вы собираетесь приобрести <span class="text-teal-700 bold">{{ $guide->title }}</span> за <span class="text-teal-700 bold">{{ $guide->price }}</span> рублей.</p>
        </div>
        <div class="my-5 text-center">
            <form action="{{ route('purchase.success', $guide) }}">
                <input type="hidden" value="{{ $guide->id }}" name="guide_id">
                <button type="submit" class="btn btn-active">Перейти к оплате</button>
            </form>
        </div>
        
    </div>
@endsection