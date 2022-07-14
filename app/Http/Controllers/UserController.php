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
        return Inertia::render('Auth/Profile', [
            'profile' => auth()->user(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, AttachAvatarToUserAction $attachAvatar)
    {
        Gate::allowIf($user->id === auth()->user()->id);
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->save();
        if ($request->hasFile('avatar')) {
            $attachAvatar($user, $request->file('avatar'));
        }

        return back()->with('success', 'Profile updated');
    }

    public function removeAvatar(Request $request, User $user, RemoveUserAvatarAction $removeAvatar)
    {
        Gate::allowIf($user->id === auth()->user()->id);
        $removeAvatar($user);

        return back()->with('success', 'Avatar removed');
    }

    public function uploadAvatar(Request $request, User $user, AttachAvatarToUserAction $attachAvatar)
    {
        Gate::allowIf($user->id === auth()->user()->id);
        $request->validate([
            'avatar' => ['required', 'file', 'image', 'max:1024', 'nullable'],
        ]);
        $attachAvatar($user, $request->file('avatar'));

        return back()->with('success', 'Avatar uploaded');


    }
}
