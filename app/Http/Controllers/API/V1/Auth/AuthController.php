<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Http\Requests\API\V1\Auth\CustomerRegisterRequest;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(CustomerRegisterRequest $request)
    {

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('ewancApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = User::find($request->email);

        if(!$user->email_verified_at) {
            //generate randomd 4 digit otp. store to user_otp table. send otp in email
            //    return $this->sendResponse($success);

        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }


    public function getRoles()
    {
        $roles = Role::where("name", "!=", "admin")->select('id', 'name')->get();
        return $this->sendResponse($roles);
    }
}
