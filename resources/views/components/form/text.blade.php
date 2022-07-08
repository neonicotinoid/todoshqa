@aware(['error'])
@props(['type' => 'text', 'error' => null])

<input x-bind:id="$id('input')" type="{{ $type }}"
    {{$attributes->except('class')}}
    {{$attributes->class(['block mt-1.5 w-full px-2.5 py-2 rounded-lg outline-none border border-gray-300 shadow-sm
                hover:border-blue-300
                placeholder:text-gray-400 placeholder:font-normal
                focus:ring-1 focus:ring-blue-500 focus:border-blue-500 ring-inset
                disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                duration-150', 'ring-1 ring-red-500 border-red-500' => $error])}}>
