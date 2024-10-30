@props(['id' => '', 'label' => '', 'value' => 0, 'sub' => null])
<div class="flex items-center gap-3">
    <label  class=" block text-lg font-medium text-gray-600">{{ $label }} </label>
<div class="relative"> 
    <input type="date" id="{{ $id }}" name="{{ $id }}" value="{{ $value }}" class="tw-input " required /> 
</div>
@if($sub)
    <p class="mt-2 text-sm text-gray-500">{{ $sub }}</p>
@endif
</div>