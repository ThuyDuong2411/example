<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UsersController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $data = $this->userService->login($request);

        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess(array('token' => $data['token'], 'user' => $data['user']));
    }

    public function register(Request $request)
    {
        $data = $this->userService->register($request);
        if($data['status'] == false) return $this->responseFail(Response::HTTP_BAD_REQUEST);
        return $this->responseSuccess($data['user']);
    }

    public function logout(Request $request) {
        if($this->userService->logout($request)) {
            return $this->responseSuccess('Logout sucessfully');
        }
        return $this->responseFail(Response::HTTP_BAD_REQUEST);
    }
}
