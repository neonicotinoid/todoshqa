@aware(['error'])
@props(['error' => null, 'type' => 'default'])

<textarea x-bind:id="$id('input')" {{$attributes->except('class')}}
        {{$attributes->class(['block mt-2 w-full px-3 py-2.5 rounded-lg outline-none border shadow-sm
                    placeholder:font-normal
                    focus:ring-1 focus:ring-blue-500 focus:border-blue-500 ring-inset
                    disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                    duration-150',
                    'hover:border-blue-300 placeholder:text-gray-400 border-gray-300 hover:border-blue-300' => $type === 'default',
                    'bg-yellow-50 border-yellow-200 hover:border-yellow-400 focus:ring-yellow-500 focus:border-yellow-500 placeholder:text-yellow-600' => $type === 'note',

                    'ring-1 ring-red-500 border-red-500' => $error])}}>{{$slot}}</textarea>
