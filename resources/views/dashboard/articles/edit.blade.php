@extends('layouts.dashboard')

@section('content')
    <div class="bg-white p-6 max-w-[1600px] mx-auto">
        <section>
            <text-editor className="{{ get_class($item) }}" :item="{!! $item !!}"></text-editor>
        </section>
    </div>
@endsection
