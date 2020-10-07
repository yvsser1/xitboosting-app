<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class adminUsersController extends Controller
{

    public function index()
    {

        $users = User::orderBy('id', 'desc')
                    ->where('show', 'yes')
                    ->get();

        return view('admin.users.index', compact( 'users'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'name' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $input['password'] = Hash::make($request->password);

                $user = User::create($input);

                return response($user);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request){

        $user = User::find($request->hidden_id);

        if(trim($request->password) == '')
        {

            $validator = Validator::make($request->all(),[

                'name' => 'required|string|max:12'

            ]);

            if($validator->passes())
            {

                if($request->ajax()) {

                    $user->name = $request->name;

                    $user->save();

                    return response($user);

                }
            }

        }
        else
        {

            $validator = Validator::make($request->all(),[

                'name' => 'required|string|max:12',
                'password' => 'required|string|min:6|confirmed'

            ]);

            $input = $request->all();

            $input['password'] = Hash::make($request->password);

            if($validator->passes())
            {

                if($request->ajax()) {

                    $user->name = $request->name;

                    $user->password = $input['password'];

                    $user->save();

                    return response($user);

                }
            }

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $users = User::orderBy('id','asc')
            ->where('show', 'yes')
            ->get();

        return response($users);

    }

    public function edit(Request $request)
    {

        $user = User::where('id', '=', $request->id)->first();

        return response()->json($user);

    }

    public function delete(Request $request)
    {

        if($request->ajax()) {

            $user = User::where('id', $request->id)->update(['show' => 'no']);

            return response()->json($user);
        }

    }

}
