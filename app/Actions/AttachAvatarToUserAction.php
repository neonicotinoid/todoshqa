<?php

namespace App\Actions;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachAvatarToUserAction
{
    public function __invoke(User $user, string|UploadedFile $image): Media
    {
        if ($user->hasMedia('avatar')) {
            $user->getFirstMedia('avatar')->delete();
        }

        if ($image instanceof UploadedFile) {
            return $user->addMedia($image)
                ->toMediaCollection('avatar');
        }

        if (is_string($image)) {
            return $user->addMediaFromDisk($image)
                ->toMediaCollection('avatar');
        }
    }
}
