<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;
use Livewire\Component;

class ProfilePage extends Component
{

    public User $user;
    public string $newPassword = '';
    public string $newPassword_confirmation = '';

    public function mount(User $user)
    {
        $this->user = $user->makeHidden('password');
    }

    protected function getRules(): array
    {
        return [
            'user.name' => ['string', 'required'],
            'user.email' => ['email'],
            'newPassword' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function saveUser()
    {
        if ($this->newPassword === '') {
            // Check without password
            $this->validate([
                'user.name' => ['string', 'required'],
                'user.email' => ['email'],
            ]);
        } else {
            $this->validate();
        }

        $this->user->save();
    }


    public function render()
    {
        return view('livewire.profile-page');
    }
}
