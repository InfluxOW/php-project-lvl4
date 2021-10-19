<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Image;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        DB::transaction(function () use ($user, $request): void {
            $user->update(['name' => $request->name]);

            if ($request->hasFile('avatar')) {
                $path = Storage::disk('s3')->put('avatars', $request->file('avatar'), 'public');

                if ($user->image) {
                    Storage::disk('s3')->delete($user->image->path);
                    $user->image->delete();
                }

                $image = Image::make([
                    'path' => $path,
                    'url' => Storage::disk('s3')->url($path)
                ]);
                $user->image()->save($image);
            }
        });

        flash(__('Profile was updated successfully!'))->success();

        return redirect()->route('users.show', $user);
    }
}
