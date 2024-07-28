<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;


class LoginFBController extends Controller
{
    //
    public function redirectToFB()
    {
        return Socialite::driver('facebooke')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFBCallback()
    {
        try {
            $user = Socialite::driver('facebooke')->user();
            // dd($user);
            
            $finduser = User::where('fb_id', $user->id)->first();
            
            if($finduser) {
                // Nếu người dùng đã tồn tại, đăng nhập người dùng bằng JWT
                $token = JWTAuth::fromUser($finduser);
                $cookie = Cookie::make('jwt_token', $token, 60 * 3);
                
                return redirect()->route('admin.home.index')->withCookie($cookie);
            } else {
                // Nếu người dùng chưa tồn tại, tạo một người dùng mới
                $newUser = User::create([
                    'fb_id' => $user->id,
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'password' => bcrypt('123456dummy') // Sử dụng bcrypt để mã hóa mật khẩu
                ]);
    
                // Gán quyền cho người dùng mới
                $userType = UserType::where('name', 'user')->first();
                $newUser->userType()->attach($userType);
    
                // Đăng nhập người dùng mới bằng JWT
                $token = JWTAuth::fromUser($newUser);
                $cookie = Cookie::make('jwt_token', $token, 60 * 3);
                
                return redirect()->route('admin.home.index')->withCookie($cookie);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
