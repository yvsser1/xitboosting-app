<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminInboxController extends Controller
{

    public function index()
    {

        $inboxs = Inbox::get();

        return view('admin.inbox.index', compact('inboxs'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'subject' => 'required|string',
            'email' => 'required|string|email',
            'description' => 'required|string'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                $inbox = Inbox::create($input);

                return response($inbox);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function loadTable()
    {

        $inboxs = Inbox::orderBy('id','desc')->get();

        return response($inboxs);

    }

    public function edit(Request $request)
    {

        $inboxs = Inbox::where('id', '=', $request->id)->first();

        return response()->json($inboxs);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            Inbox::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }

}
