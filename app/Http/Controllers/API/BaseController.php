<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message ='Success', $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'result'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['result'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
