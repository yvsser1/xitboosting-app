<?php

namespace App\Http\Controllers;


use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminServersController extends Controller
{
    public function index(){

        $servers = Server::get();

        return view('admin.server.index', compact('servers'));

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

                $project = Server::create($input);

                return response($project);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $server = Server::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $server->update($input);

                return response($server);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $server = Server::get();

        return response($server);

    }

    public function edit(Request $request)
    {

        $server = Server::where('id', '=', $request->id)->first();

        return response()->json($server);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            Server::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
