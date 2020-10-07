<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class changePasswordController extends Controller
{

    public function update(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);

        $validator = Validator::make($request->all(),[

            'oldPassword' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                if (Hash::check($request->oldPassword, $user->password)) {

                    $user->password = Hash::make($request->password);

                    $user->save();

                    return response($user);
                } else {
                    return response()->json(['error'=>['Old password does not match!']]);
                }
            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

}
