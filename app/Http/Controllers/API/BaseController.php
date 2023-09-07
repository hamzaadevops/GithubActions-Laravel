<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{


    // protected function validateRequest(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    // {
    //     try {
    //         $this->validate($request, $rules, $messages, $customAttributes);
    //     } catch (ValidationException $exception) {
    //         throw new ValidationException(
    //             $exception->validator,
    //             $this->respondWithMessage($exception->getMessage(), 422),
    //             $exception->errors()
    //         );
    //     }
    // }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $error = null)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'error' => $error
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
