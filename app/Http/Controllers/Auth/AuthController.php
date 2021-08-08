<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\RegisterUser;
use App\Events\ForgotUser;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgotRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Đăng ký
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
            'status' => Config::SUCCESS,
            'token' => $token,
        ]);
    }

    // Đăng nhập
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('App')->plainTextToken;

            return response()->json([
                'status' => Config::SUCCESS,
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => Config::FAILURE,
        ]);
    }

    // Thông tin người dùng
    public function user()
    {
        return response()->json([
            'status' => Config::SUCCESS,
            'user' => Auth::user(),
        ]);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'status' => Config::SUCCESS,
        ]);
    }

    // Quên mật khẩu
    public function forgot(ForgotRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user) {
            $token = $user->createToken('App')->plainTextToken;

            $link = Config::FRONTEND_NEWPASSWORD . $token;

            event( new ForgotUser($request->email, $link));
            
            return response()->json([
                'status' => Config::SUCCESS,
            ]);
        }

        return response()->json([
            'status' => Config::FAILURE,
        ]);
    }

    // Đăng nhập Socialite
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

    // Chuyển hương Socialite   
    public function callback($provider)
    {
        $getUser = Socialite::driver($provider)->stateless()->user();
        $information = $getUser->user;

        $user = User::where('email', $information['email'])->first();

        if(!$user)
        {
            $user = new User;

            $user->name = $information['name'];
            $user->email = $information['email'];
            $user->avatar = $getUser->getAvatar();
            $user->password = Hash::make($information['email']);
            $user->slug = Str::slug($information['name'], '-');
    
            $user->save();

            event(new RegisterUser($user));
        }

        $token = $user->createToken('App')->plainTextToken;

        return redirect()->away(Config::FRONTEND_SOCIAL . $token);
    }
}
