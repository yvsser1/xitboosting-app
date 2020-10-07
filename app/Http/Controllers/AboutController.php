<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index(){

        $abouts = About::get();

        return view('admin.about.index', compact('abouts'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'name' => 'required|string',
            'text' => 'required|string'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $about = About::create($input);

                return response($about);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $about = About::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string',
            'text' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $about->update($input);

                return response($about);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $about = About::get();

        return response($about);

    }

    public function edit(Request $request)
    {

        $about = About::where('id', '=', $request->id)->first();

        return response()->json($about);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            About::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
