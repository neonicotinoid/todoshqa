@props(['text', 'backgrounds' => [
                '#78716C',
                '#DC2626',
                '#EA580C',
                '#D97706',
                '#CA8A04',
                '#65A30D',
                '#16A34A',
                '#059669',
                '#0D9488',
                '#0891B2',
                '#0284C7',
                '#2563EB',
                '#4F46E5',
                '#7C3AED',
                '#9333EA',
                '#C026D3',
                '#DB2777',
                '#E11D48'
            ]])

@php
    $initials = (new \App\Services\Initials())->generate($text);
    $bg = (new \App\Actions\GetNCacheInitialBackgroundColorAction())(auth()->user(), Arr::random($backgrounds));
@endphp

<svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="49.5" fill="{{ $bg  }}" />
    <text font-size="46" fill="#FFFFFF" x="50%" y="50%" dy=".1em" style="line-height:1" alignment-baseline="middle" text-anchor="middle" dominant-baseline="central">
        {{$initials}}
    </text>
</svg>
