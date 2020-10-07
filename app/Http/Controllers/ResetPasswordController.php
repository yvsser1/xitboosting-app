<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{

    function resetMail (Request $request){
        $validator = Validator::make($request->all(),[

            'email' => 'required|string|email|max:255'

        ]);

        if($validator->passes()) {

            if ($request->ajax()) {

                $newPassword = rand(100000,999999);

                $newPasswordHash = Hash::make($newPassword);

                $userGet = User::where('email', $request->email)->first();

                if(!empty($userGet->name)){

                    $user = User::where('email', $request->email);

                    $user->update(['password' => $newPasswordHash]);

                    $data = array(
                        'name'      => $userGet->name,
                        'password'  =>  $newPassword
                    );

                    Mail::to($request->email)->send(new ResetPassword($data));

                    return response($data);

                }

                return response()->json(['error' => 'This email not valid']);

            }

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

}
