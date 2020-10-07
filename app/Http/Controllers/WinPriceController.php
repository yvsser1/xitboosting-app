<?php

namespace App\Http\Controllers;

use App\Leagues;
use App\WinPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WinPriceController extends Controller
{
    public function index()
    {

        $winPrices = WinPrice::with('nowLeagues')->with('nowDivisions')->get();

        $leagues = Leagues::all();

        return view('admin.winPrice.index', compact('winPrices','leagues'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'now_league_id' => 'required',
            'now_division_id' => 'required',
            'games' => 'required',
            'price' => 'required'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $winPrice = WinPrice::create($input);

                return response($winPrice);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $winPrice = WinPrice::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'now_league_id' => 'required',
            'now_division_id' => 'required',
            'games' => 'required',
            'price' => 'required'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $winPrice->update($input);

                return response($winPrice);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $winPrices = WinPrice::with('nowLeagues')->with('nowDivisions')->get();

        return response($winPrices);

    }

    public function edit(Request $request)
    {

        $winPrices = WinPrice::where('id', '=', $request->id)->first();

        return response()->json($winPrices);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            WinPrice::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
