@extends('layouts.dashboard')

@section('content')
    <div class="bg-white p-6 max-w-[1600px] mx-auto">
        <section>
            <page-editor :id="{{ $id ?? null }}"></page-editor>
        </section>
    </div>
@endsection
