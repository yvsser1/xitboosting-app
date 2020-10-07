<?php

namespace App\Http\Controllers;

use App\CoachingPrice;
use App\DuoPrice;
use App\ServicePrice;
use App\SoloPrice;
use App\WinPrice;
use Illuminate\Http\Request;

class getPrice extends Controller
{
    public function index(Request $request){
        $servicePrice = ServicePrice::where('service',$request->service)
            ->first();

        if(!$servicePrice){
            return 0;
        }

        if($request->type == 'coaching')
        {
            $coachingPrice = CoachingPrice::where('rank',$request->rank)
                ->where('hours',$request->hours)
                ->first();

            if(!$coachingPrice){
                return 0;
            }

            $price = $coachingPrice->price + ($coachingPrice->price * $servicePrice->price / 100);

            return $price ? $price : 0;
        }
        else if($request->type == 'solo')
        {
            $soloPrice = SoloPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('next_league_id',$request->next_league_id)
                ->where('next_division_id',$request->next_division_id)
                ->first();

            if(!$soloPrice){
                return 0;
            }

            $price = $soloPrice->price + ($soloPrice->price * $servicePrice->price / 100);

            return $price ? $price : 0;
        }
        else if($request->type == 'duo')
        {
            $duoPrice = DuoPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('next_league_id',$request->next_league_id)
                ->where('next_division_id',$request->next_division_id)
                ->first();

            if(!$duoPrice){
                return 0;
            }

            $price = $duoPrice->price + ($duoPrice->price * $servicePrice->price / 100);

            return $price ? $price : 0;
        }
        else if($request->type == 'win')
        {
            $winPrice = WinPrice::where('now_league_id',$request->now_league_id)
                ->where('now_division_id',$request->now_division_id)
                ->where('games',$request->games)
                ->first();

            if(!$winPrice){
                return 0;
            }

            $price = $winPrice->price + ($winPrice->price * $servicePrice->price / 100);

            if ($request->game_service == 'duo') {
                $price = $price*2;
            }

            return $price ? $price : 0;
        }
        return false;
    }
}
