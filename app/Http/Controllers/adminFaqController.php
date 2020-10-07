<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminFaqController extends Controller
{

    public function index(){

        $faqs = Faq::get();

        return view('admin.faq.index', compact('faqs'));

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

                $project = Faq::create($input);

                return response($project);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $faq = Faq::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $faq->update($input);

                return response($faq);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $faq = Faq::get();

        return response($faq);

    }

    public function edit(Request $request)
    {

        $faq = Faq::where('id', '=', $request->id)->first();

        return response()->json($faq);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            Faq::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }

}
