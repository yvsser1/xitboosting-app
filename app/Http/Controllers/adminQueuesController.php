<?php

namespace App\Http\Controllers;

use App\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminQueuesController extends Controller
{
    public function index(){

        $queues = Queue::get();

        return view('admin.queue.index', compact('queues'));

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

                $project = Queue::create($input);

                return response($project);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $queue = Queue::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                $queue->update($input);

                return response($queue);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $queue = Queue::get();

        return response($queue);

    }

    public function edit(Request $request)
    {

        $queue = Queue::where('id', '=', $request->id)->first();

        return response()->json($queue);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {

            Queue::whereIn('id', $request->id)->delete();

            return response()->json($request);
        }

    }
}
