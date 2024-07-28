<?php

namespace App\Http\Controllers\Auth;

// use Tymon\JWTAuth\JWTAuth;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\LoginAdminRequest;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['index','login','infor','logout']]);
    }


    public function index(){
        return view('Auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->back()->with(['error' => 'Tài khoản hoặc mật khẩu không chính xác']);
        }

        $cookie = Cookie::make('jwt_token', $token, 60 * 3);
        

        return redirect()->route('admin.home.index')->withCookie($cookie);
    }
    public function logout(Request $request)
    {
        $token = $request->cookie('jwt_token');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        
        JWTAuth::invalidate(JWTAuth::getToken());
        $cookie = Cookie::forget('jwt_token');
        $response = response()->json(['message' => 'Logout successful'])->withCookie($cookie);

        return $response->header('Location', route('auth.index'))->setStatusCode(302);
    }

    public function register(RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->emailReg,
            'password' => bcrypt($request->passwordReg),
        ]);
        $userType = UserType::where('name', 'user')->first();
        $user->userType()->attach($userType);

        return redirect()->route('auth.index')->with(['success' => 'đăng ký thành công']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
