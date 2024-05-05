<?php

namespace App\Http\Controllers\API;


use App\Models\Tour;
use App\Models\Distination;
use App\Models\TourDistination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourDistinationController extends Controller
{

    public function index($id_tour)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }
    
        $distinations = $tour->distinations()->get()->mapWithKeys(function ($distination) {
            return [
                'ville' => $distination->ville,
                'pays' => $distination->pays
        ];
        });
    
        return response()->json([
            'status' => 200,
            'tour' => $tour,
            'distinations' => $distinations,
        ]);
    }
 

 ///////////////////////////////////////////////////////// 


    public function addDistination(Request $request, $id_tour, $id_distination)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $distination = Distination::find($id_distination);
        if (!$distination) {
            return response()->json(['message' => "Distination with ID '{$id_distination}' not found"], 404);
        }

        $tour->distinations()->attach($id_distination);

        return response()->json(['message' => "Distination '{$distination->ville} - {$distination->pays}' added successfully"], 200);
    }


// ////////////////////////////////////


    public function removeDistination(Request $request, $id_tour, $id_distination)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $distination = Distination::find($id_distination);
        if (!$distination) {
            return response()->json(['message' => "Distination with ID '{$id_distination}' not found"], 404);
        }

        $tour->distinations()->detach($id_distination);

        return response()->json(['message' => "Distination '{$distination->ville} - {$distination->pays}' removed successfully"], 200);
    }
}
