<?php

namespace App\Actions;

use Illuminate\Support\Facades\Cache;

class GetNCacheInitialBackgroundColorAction
{
    public const CACHE_TTL = 3600 * 60 * 24;

    public function __invoke(int $userId, $hex): string
    {
        return Cache::remember('user-initial-'. $userId, self::CACHE_TTL, function () use($hex) {
            return $hex;
        });
    }

}
