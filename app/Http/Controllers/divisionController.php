<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;

class divisionController extends Controller
{
    public function index(Request $request)
    {

        $divisions = Division::where('league_id',$request->league_id)->with('photo')->get();

        return response($divisions);

    }
}
