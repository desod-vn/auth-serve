<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\RegisterUser;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function test()
    {
        if (!Cache::has('user'))
        {
            Cache::set('user', User::all(), now()->addMinutes(10)); 
        }

        $user = Cache::get('user');

        return response()->json([
            'user' => $user,
        ]);
    }

    // Register
    public function register(RegisterRequest $request) 
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->slug = Str::slug($request->name, '-');

        $user->save();

        event(new RegisterUser($user));
        
        $token = $user->createToken('App')->plainTextToken;
        
        return response()->json([
            'status' => true,
            'token' => $token,
        ]);
    }

    // Login
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('App')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    // Infomation
    public function user()
    {
        if (!Cache::has('user'))
        {
            Cache::set('user',Auth::user(), now()->addMinutes(10)); 
        }

        $user = Cache::get('user');

        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }

    // Logout
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        $information = Socialite::driver($provider)->user()->user;

        $user = User::where('email', $information['email'])->first();

        if(!$user)
        {
            $user = new User;

            $user->name = $information['name'];
            $user->email = $information['email'];
            $user->password = Hash::make($information['email']);
            $user->slug = Str::slug($information['name'], '-');
    
            $user->save();
        }

        $token = $user->createToken('App')->plainTextToken;
        
        return redirect()->away('http://localhost?token=' . $token);
    }
}
