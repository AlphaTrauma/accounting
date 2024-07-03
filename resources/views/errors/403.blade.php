@extends('layouts.app')

@section('content')
    <div class="container text-center h-[80vh] flex flex-col justify-center">
        <h1 class="text-gray-500 text-3xl">Ошибка 403</h1>
        <p>Доступ к запрашиваемой странице запрещен или у пользователя нет прав на просмотр контента.</p>
        <a href="/" class="underline text-blue-800">На главную</a>
    </div>
@endsection
