<?php

namespace App\Http\Controllers;

use App\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicePriceController extends Controller
{
    public function index()
    {

        $servicePrices = ServicePrice::all();

        return view('admin.servicePrice.index', compact('servicePrices'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'price' => 'required|string',
            'service' => 'required|string'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $user = ServicePrice::create($input);

                return response($user);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $servicePrice = ServicePrice::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'price' => 'required|string',
            'service' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $servicePrice->update($input);

                return response($servicePrice);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $servicePrice = ServicePrice::orderBy('id','desc')->get();

        return response($servicePrice);

    }

    public function edit(Request $request)
    {

        $servicePrice = ServicePrice::where('id', '=', $request->id)->first();

        return response()->json($servicePrice);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            ServicePrice::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
