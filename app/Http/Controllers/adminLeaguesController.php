<?php

namespace App\Http\Controllers;

use App\Leagues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminLeaguesController extends Controller
{

    public function index()
    {

        $leagues = Leagues::all();

        return view('admin.leagues.index', compact('leagues'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();


                $user = Leagues::create($input);


                return response($user);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $league = Leagues::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $league->update($input);

                return response($league);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $leagues = Leagues::get();

        return response($leagues);

    }

    public function edit(Request $request)
    {

        $leagues = Leagues::where('id', '=', $request->id)->first();

        return response()->json($leagues);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            Leagues::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }

}
