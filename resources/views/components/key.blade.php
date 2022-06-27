
<div
    {{ $attributes->except(['class']) }}
    @class(['inline-block px-1 py-0.5 text-xs rounded-md shadow-sm border border-gray-300 text-gray-500'])>
    {{$slot}}
</div>
