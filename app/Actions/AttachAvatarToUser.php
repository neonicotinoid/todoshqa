<?php

namespace App\Actions;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachAvatarToUser
{
    public function __invoke(User $user, string $image_path): Media
    {
        if ($user->hasMedia('avatars')) {
            $user->getFirstMedia('avatars')->delete();
        }

        return $user->addMediaFromDisk($image_path)
            ->toMediaCollection('avatars');
    }
}
