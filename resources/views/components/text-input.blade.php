@props(['disabled' => false, 'id' => '', 'label' => '', 'required' => false])

<div class="relative z-0 w-full mb-5 group">
    <input {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} type="text" id="{{ $id }}" name="{{ $id }}" placeholder=""
         class="block py-3 px-0 w-full text-xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
         appearance-none focus:outline-none focus:ring-0 focus:border-cyan-700 peer">
    <label for="{{ $id }}" class="peer-focus:font-medium absolute text-xl text-gray-500 duration-300 transform 
    -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto
     peer-focus:text-cyan-700  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
     peer-focus:scale-75 peer-focus:-translate-y-6">
         {{ $label }}
    </label>
</div> 
