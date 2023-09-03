<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{


    public function loginPatient(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        $patient= Patient::where('email', $credentials['email'])->first();


        // if (Auth::attempt($credentials)) {
        //     $token = $user->createToken('authToken')->plainTextToken;
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'user logged-in successfully',
        //         'token'  => $token
        //     ]);
        // } else {

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Invalid email or password',
        //     ]);
        // }
    }


    public function registerPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|',
            'age' => 'required|min:1|integer|',
            'weight' => 'required|min:0|',
            // fix validation for negative numbers
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {

            $patient = Patient::where('email', $request->email)->first();
            if (is_null($patient)) {
                if ($request->confirmpassword == $request->password) {
                    $patient = new Patient();
                    $patient->name = $request->name;
                    $patient->email = $request->email;
                    $patient->password = bcrypt($request->password);
                    $patient->age = $request->age;
                    $patient->weight = $request->weight;
                    $patient->health = $request->health;
                    $patient->save();

                    $token = $patient->createToken('authToken')->plainTextToken;

                    return response()->json([
                        'status' => true,
                        'message' => 'Patient Created Successfully',
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
                    'message' => 'Patient already exists'
                ]);
            }
        }
    }

    public function deletePatient($id)
    {

        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json('patient not found');
        }

        $patient->delete();
        return response()->json('patient deleted successfully');
    }



    public function editPatient(Request $request, $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {

            return response()->json([
                'status' => 'false',
                'message' => 'patient not found'
            ]);
        } else {

            if ($request->confirmpassword == $request->password) {

                $patient->age = $request->age;
                $patient->weight = $request->weight;
                $patient->health = $request->health;
                $patient->password = bcrypt($request->password);
                $patient->save();

                return response()->json([
                    'status' => true,
                    'message' => 'edit patient completed'
                ]);
            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'confirm password error'
                ]);
            }
        }
    }


    public function logoutPatient()
    {
        Auth::logout();
    }
}
