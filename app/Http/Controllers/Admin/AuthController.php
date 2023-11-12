<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function login(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, 422);
        }
        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            $user = Auth::guard('admin')->user();
            $success['token'] = $user->createToken('admin')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Admin login successfully.'
            ];

            return response()->json($response, 201);
        }else{
            $response = [
                'success' => false,
                'message' => 'failed to login.',
            ];

            return response()->json($response, 400);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        $response = [
            'success' => true,
            'message' => 'Admin logged out successfully.',
        ];

        return response()->json($response, 200);
    }
}
