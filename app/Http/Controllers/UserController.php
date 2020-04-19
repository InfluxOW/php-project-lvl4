<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use App\Http\Requests\UserValidation;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserValidation  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserValidation $request, User $user)
    {
        $user->update(['name' => $request->name]);

        if ($request->hasFile('avatar')) {
            $path = Storage::disk('s3')->put("avatars", $request->file('avatar'), 'public');

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

        flash(__('User was updated successfully!'))->success();

        return redirect()->route('users.show', $user);
    }
}
