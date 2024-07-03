
@extends('layouts.app')

@section('content')
    <div class="container text-center h-[80vh] flex flex-col justify-center">
        <h1 class="text-gray-500 text-3xl">Ошибка 429</h1>
        <p>Пользователь отправил слишком много запросов за единицу времени. Подождите и попробуйте снова.</p>
        <a href="/" class="underline text-blue-800">На главную</a>
    </div>
@endsection
