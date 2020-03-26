<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data = [])
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $data
        ]);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseFail($code = Response::HTTP_BAD_REQUEST, $data = [])
    {
        return response()->json([
            'code' => $code,
            'data' => $data
        ]);
    }
}
