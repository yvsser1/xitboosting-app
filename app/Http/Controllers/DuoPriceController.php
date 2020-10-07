<?php

namespace App\Http\Controllers;

use App\DuoPrice;
use App\Leagues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DuoPriceController extends Controller
{
    public function index()
    {

        $duoPrices = DuoPrice::with('nowLeagues')->with('nowDivisions')->with('nextLeagues')->with('nextDivisions')->get();

        $leagues = Leagues::all();

        return view('admin.duoPrice.index', compact('duoPrices','leagues'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'now_league_id' => 'required',
            'now_division_id' => 'required',
            'next_league_id' => 'required',
            'next_division_id' => 'required',
            'price' => 'required'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $user = DuoPrice::create($input);

                return response($user);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $duoPrice = DuoPrice::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'now_league_id' => 'required',
            'now_division_id' => 'required',
            'next_league_id' => 'required',
            'next_division_id' => 'required',
            'price' => 'required'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $duoPrice->update($input);

                return response($duoPrice);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $duoPrices = DuoPrice::with('nowLeagues')->with('nowDivisions')->with('nextLeagues')->with('nextDivisions')->get();

        return response($duoPrices);

    }

    public function edit(Request $request)
    {

        $duoPrices = DuoPrice::where('id', '=', $request->id)->first();

        return response()->json($duoPrices);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            DuoPrice::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
