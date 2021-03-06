<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            Log::info('request', [$request->all()]);
            $this->validate($request,
                [
                    'email'     =>  'required|email',
                    'password'  =>  'required'
                ]
            );
            $credentials    =   request(['email', 'password']);
            if (auth()->attempt($credentials)) {

                $user       =   User::query()
                    ->where('email', '=', request('email'))
                    ->first()
                ;

                if ($user->api_token === '') {

                    $user->api_token    =   Str::random(40);

                }
                $user->update(['api_token' => $user->api_token]);

                return response(
                    [
                        'token'     =>  $user['api_token']
                    ],
                    Response::HTTP_OK);
            } else {
                return response(
                    [
                        'message'   =>  'auth check failed'
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (ValidationException $exception) {
            Log::error('error message ', [$exception->getMessage(), $exception->getTraceAsString()]);
            return response(
                [
                    'message'   => 'validation error'
                ],
                Response::HTTP_BAD_REQUEST);
        }
    }


    public function isLoggedNow(Request $request)
    {
        $token  =   $request->get('token');
        if (User::query()->where('api_token', '=', $token)->count()) {
            return response(['status' => true], Response::HTTP_OK);
        } else {
            return response(['status' => false], Response::HTTP_UNAUTHORIZED);
        }

    }


    public function logout()
    {

    }
}
