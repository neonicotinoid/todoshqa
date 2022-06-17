@props(['label'])

<label class="inline-flex items-center hover:bg-gray-100 rounded-lg px-2.5 -mx-2.5 py-1 duration-150">
    <input type="checkbox" class="rounded w-4 h-4 text-purple-600 focus:ring-purple-500" {{$attributes}}>
    <span class="block text-gray-700 ml-2">
        {{$label}}
    </span>
</label>
