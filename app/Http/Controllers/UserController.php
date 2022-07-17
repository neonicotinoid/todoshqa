<?php

namespace App\Http\Controllers;

use App\Actions\AttachAvatarToUserAction;
use App\Actions\RemoveUserAvatarAction;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $this->authorize('update', auth()->user());
        return Inertia::render('Auth/Profile', [
            'profile' => auth()->user(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, AttachAvatarToUserAction $attachAvatar)
    {
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->save();

        return back()->with('success', 'Profile updated');
    }

    public function removeAvatar(Request $request, User $user, RemoveUserAvatarAction $removeAvatar)
    {
        $this->authorize('update', $user);

        $removeAvatar($user);
        return back()->with('success', 'Avatar removed');
    }

    public function uploadAvatar(Request $request, User $user, AttachAvatarToUserAction $attachAvatar)
    {
        $this->authorize('update', $user);

        $request->validate([
            'avatar' => ['required', 'file', 'image', 'max:1024', 'nullable'],
        ]);
        $attachAvatar($user, $request->file('avatar'));

        return back()->with('success', 'Avatar uploaded');


    }
}
