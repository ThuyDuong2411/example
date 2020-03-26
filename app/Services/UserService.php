<?php


namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!($token = JWTAuth::attempt($credentials))) {
            return array('status' => false);
        }

        return array('status' => true, 'token' => $token, 'user' => Auth::user());
    }

    public function register(Request $request)
    {
        $params = $request->only('email', 'name', 'password');
        $user = new User();
        $user->email = $params['email'];
        $user->name = $params['name'];
        $user->password = bcrypt($params['password']);

        try {
            $user->save();
        } catch (\Exception $exception) {
            return array('status' => false, 'user' => $user);
        }

        return array('status' => true, 'user' => $user);
    }

    public function logout(Request $request) {
        try {
            JWTAuth::invalidate($request->input('token'));
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }
}
