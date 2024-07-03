@extends('layouts.app')

@section('content')
    <div class="container text-center h-[80vh] flex flex-col justify-center">
        <h1 class="text-gray-500 text-3xl">Ошибка 503</h1>
        <p>Сервер не готов обработать данный запрос. Возможно, на сервере проводятся технические работы</p>
        <a href="/" class="underline text-blue-800">На главную</a>
    </div>
@endsection
