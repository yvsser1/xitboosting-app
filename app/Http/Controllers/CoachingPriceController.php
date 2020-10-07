<?php

namespace App\Http\Controllers;

use App\CoachingPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoachingPriceController extends Controller
{
    public function index()
    {

        $coachingPrices = CoachingPrice::all();

        return view('admin.coachingPrice.index', compact('coachingPrices'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'price' => 'required|string',
            'rank' => 'required|string',
            'hours' => 'required'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $user = CoachingPrice::create($input);

                return response($user);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $coachingPrice = CoachingPrice::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'hours' => 'required|string',
            'rank' => 'required|string',
            'price' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $coachingPrice->update($input);

                return response($coachingPrice);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $divisions = CoachingPrice::orderBy('id','desc')->get();

        return response($divisions);

    }

    public function edit(Request $request)
    {

        $divisions = CoachingPrice::where('id', '=', $request->id)->first();

        return response()->json($divisions);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            CoachingPrice::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
