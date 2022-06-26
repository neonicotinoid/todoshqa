<?php

namespace App\Http\Livewire;

use App\Actions\AttachAvatarToUserAction;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfilePage extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;

    public User $user;
    public ?Media $currentAvatar = null;
    public $preloadedAvatar = null;
    public string $newPassword = '';
    public string $newPassword_confirmation = '';

    public function mount(User $user)
    {
        $this->user = $user->makeHidden('password');
        $this->currentAvatar = $this->user->getFirstMedia('avatar');
    }

    protected function getRules(): array
    {
        return [
            'user.name' => ['string', 'required', 'min:3'],
            'user.email' => ['email'],
            'preloadedAvatar' => ['file', 'image', 'max:1024', 'nullable'],
            'newPassword' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function saveUser()
    {
        $this->authorize('update', [User::class, $this->user]);
        if ($this->newPassword === '') {
            // Check without password
            $this->validate([
                'user.name' => ['string', 'required', 'min:3'],
                'user.email' => ['email'],
            ]);
        } else {
            $this->validate();
        }

        $this->user->save();
    }

    public function removeAvatar()
    {
        $this->authorize('update', [User::class, $this->user]);
        $this->currentAvatar->delete();
        $this->currentAvatar = null;
        $this->preloadedAvatar = null;
    }

    public function approvePreloadedAvatar(AttachAvatarToUserAction $action)
    {
        $this->authorize('update', [User::class, $this->user]);
        $this->currentAvatar = $action($this->user, $this->preloadedAvatar);
        $this->preloadedAvatar = null;
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
