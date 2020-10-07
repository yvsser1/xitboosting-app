<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminGalleryController extends Controller
{

    public function index()
    {

        $gallerys = Gallery::all();

        return view('admin.gallery.index', compact('gallerys'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'name' => 'required|string',
            'photo_id' => 'required'

        ]);

        if($validator->passes())
        {

            if($request->ajax())
            {

                $input = $request->all();

                if($file = $request->file('photo_id')){

                    $name = time() . $file->getClientOriginalName();

                    $file->move('images',$name);

                    $photo = Photo::create(['name'=>$name]);

                    $input['photo_id'] = $photo->id;

                }

                $gallery = Gallery::create($input);


                return response($gallery);

            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public  function  update(Request $request)
    {

        $gallery = Gallery::findOrFail($request->hidden_id);


        $validator = Validator::make($request->all(),[

            'name' => 'required|string'

        ]);

        $input = $request->all();

        if($validator->passes())
        {

            if($request->ajax()) {

                if ($file = $request->file('photo_id')) {

                    if ($gallery->photo_id != 0) {

                        $old_photo = Photo::findOrFail($gallery->photo_id);

                        unlink(public_path() .'/images/'. $old_photo->name);

                        Photo::findOrFail($gallery->photo_id)->delete();

                    }

                    $name = time() . $file->getClientOriginalName();

                    $file->move('images', $name);

                    $photo = Photo::create(['name' => $name]);

                    $input['photo_id'] = $photo->id;

                }

                $gallery->update($input);

                return response($gallery);

            }
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function loadTable()
    {

        $gallerys = DB::table('gallerys')
            ->leftJoin('photos', 'gallerys.photo_id', '=', 'photos.id')
            ->select('gallerys.*', 'photos.name as p_name')
            ->orderBy('gallerys.id','desc')
            ->get();

        return response($gallerys);

    }

    public function edit(Request $request)
    {

        $gallerys = DB::table('gallerys')
            ->leftJoin('photos', 'gallerys.photo_id', '=', 'photos.id')
            ->select('gallerys.*', 'photos.name as p_name')
            ->where('gallerys.id', '=', $request->id)
            ->first();

        return response()->json($gallerys);

    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            DB::table('gallerys')
                ->whereIn('id', $request->id)
                ->delete();

            return response()->json($request);
        }

    }

}
