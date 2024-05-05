<?php

namespace App\Http\Controllers\API;

use App\Models\Tour;
use App\Models\Hotel;
use App\Models\TourHotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourHotelController extends Controller
{

    public function index($id_tour)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }
    
        $hotels = $tour->hotels()->get()->mapWithKeys(function ($hotel) {
            return [$hotel->nom => [
                'email' => $hotel->email,
                'num_tel' => $hotel->num_tel,
                'ville' => $hotel->ville,
                'pays' => $hotel->pays,
                'adress' => $hotel->adress,
                'nbr_etoile' => $hotel->nbr_etoile,
                'logo' => $hotel->logo,
            ]];
        });
    
        return response()->json([
            'status' => 200,
            'tour' => $tour,
            'hotels' => $hotels,
        ]);
    }
 

 ///////////////////////////////////////////////////////// 


    public function addDistination(Request $request, $id_tour, $id_hotel)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $hotel = Hotel::find($id_hotel);
        if (!$hotel) {
            return response()->json(['message' => "Hotel with ID '{$id_hotel}' not found"], 404);
        }

        $tour->hotels()->attach($id_hotel);

        return response()->json(['message' => "Hotel '{$hotel->nom} - {$hotel->ville}' added successfully"], 200);
    }


// ////////////////////////////////////


    public function removeDistination(Request $request, $id_tour, $id_hotel)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $hotel = Hotel::find($id_hotel);
        if (!$hotel) {
            return response()->json(['message' => "Hotel with ID '{$id_hotel}' not found"], 404);
        }

        $tour->hotels()->detach($id_hotel);

        return response()->json(['message' => "Hotel '{$hotel->nom} - {$hotel->ville}' removed successfully"], 200);
    }
}
