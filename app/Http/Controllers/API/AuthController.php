<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'user logged-in successfully',
                'token'  => $token
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ]);
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {


            $user = User::where('email', $request->email)->first();
            if (is_null($user)) {
                if ($request->confirmpassword == $request->password) {
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->save();

                    $token = $user->createToken('authToken')->plainTextToken;

                    return response()->json([
                        'status' => true,
                        'message' => 'User Created Successfully',
                        'token' => $token
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'confirm password error'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User already exists'
                ]);
            }
        }
    }

    public function deleteUser($id)
    {

        $user = User::find($id);
        if (!$user) {
            return response()->json('user not found');
        }

        $user->delete();
        return response()->json('user deleted successfully');
    }



    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json('user not found');
        } else {
            if ($request->confirmpassword == $request->password) {

                $user->password = bcrypt($request->password);
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'edit user completed'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'confirm password error'
                ]);
            }
        }
    }


    public function getUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json('user not found');
        } else {
            return response()->json([
                $user
            ]);
        }
    }


    public function logoutUser()
    {
        Auth::logout();
    }
}
