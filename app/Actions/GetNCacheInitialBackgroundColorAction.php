<?php

namespace App\Actions;

use Arr;
use Illuminate\Support\Facades\Cache;

class GetNCacheInitialBackgroundColorAction
{
    public const CACHE_TTL = 3600 * 60 * 24;

    public function __invoke(int $userId): string
    {
        $bg = [
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
            '#E11D48', ];

        return Cache::remember('user-initial-'.$userId, self::CACHE_TTL, function () use ($bg) {
            return Arr::random($bg);
        });
    }
}
