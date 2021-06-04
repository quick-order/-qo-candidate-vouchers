<?php

namespace App\Http\Api\V1_1\Controllers\User;

use App\Enums\UserRoleEnum;
use App\Facades\Token\TokenClassFacade;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthController
 * @package App\Http\Api\V1_1\Controllers\User
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                $errors->getMessages(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = TokenClassFacade::createCustomerToken($user);

        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'message' => 'Invalid login',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = TokenClassFacade::createCustomerToken($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        $user = Auth::user();
        if (!$user->tokenCan(UserRoleEnum::CUSTOMER)) {
            return response()->json(
                [
                    'message' => 'Requested endpoint is forbidden',
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        return $request->user();
    }
}
