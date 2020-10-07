<?php

namespace App\Http\Controllers;

use App\Leagues;
use App\SoloPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoloPriceController extends Controller
{
    public function index()
    {

        $soloPrices = SoloPrice::with('nowLeagues')->with('nowDivisions')->with('nextLeagues')->with('nextDivisions')->get();

        $leagues = Leagues::all();

        return view('admin.soloPrice.index', compact('soloPrices','leagues'));

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

                $soloPrice = SoloPrice::create($input);

                return response($soloPrice);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $league = SoloPrice::findOrFail($request->hidden_id);


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

                $league->update($input);

                return response($league);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $soloPrices = SoloPrice::with('nowLeagues')->with('nowDivisions')->with('nextLeagues')->with('nextDivisions')->get();

        return response($soloPrices);

    }

    public function edit(Request $request)
    {

        $soloPrices = SoloPrice::where('id', '=', $request->id)->first();

        return response()->json($soloPrices);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            SoloPrice::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
