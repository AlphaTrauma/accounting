@extends('layouts.dashboard')

@section('content')
    <div class="bg-white p-6 max-w-[1600px] mx-auto">
        <section>
            <article-editor :category="{{ request()->has('category_id') ? request()->category_id : 0 }}" :id="{{ $id ?? null }}"></article-editor>
        </section>
    </div>
@endsection
