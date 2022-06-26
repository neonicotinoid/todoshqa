<?php

namespace App\Actions;

use App\Models\User;

class GetNCacheInitialBackgroundColorAction
{
    public const CACHE_TTL = 3600 * 30;

    public function __invoke(User $user, $hex): string
    {
        return \Cache::remember('user-initial:'. $user->id, self::CACHE_TTL, function () use($hex) {
            return $hex;
        });
    }

}
