@aware(['error'])
@props(['error' => null])

<textarea x-bind:id="$id('input')" {{$attributes->except('class')}}
        {{$attributes->class(['block mt-2 w-full px-3 py-2.5 rounded-lg outline-none border border-gray-300 shadow-sm
                    hover:border-purple-300
                    placeholder:text-gray-400 placeholder:font-normal
                    focus:ring-1 focus:ring-purple-500 focus:border-purple-500 ring-inset
                    disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                    duration-150', 'ring-1 ring-red-500 border-red-500' => $error])}}>{{$slot}}</textarea>
