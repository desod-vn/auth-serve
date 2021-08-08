<?php

namespace App\Http\Controllers\User;

use App\Config;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\NewPasswordRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\AvatarRequest;


class UserController extends Controller
{

    public function new_password(NewPasswordRequest $request, User $user)
    {
        $this->authorize('update', $user);
        
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }

    public function avatar(AvatarRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $image = substr($user->avatar, strlen(Config::BACKEND));

        if($request->has('image'))
        {
            Storage::delete($image);
            $image = $request->file('image')->store(Config::USER_IMG);
            $user->avatar = Config::BACKEND . $image;
        }
        
        $user->save();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }

    public function password(PasswordRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'status' => Config::SUCCESS,
            'data' => $user,
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->story = $request->story;

        $user->save();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('update', $user);

        $user->delete();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }
}
