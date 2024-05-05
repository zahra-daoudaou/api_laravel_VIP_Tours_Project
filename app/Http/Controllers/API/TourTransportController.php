<?php

namespace App\Http\Controllers\API;

use App\Models\Tour;
use App\Models\Transport;
use App\Models\TourTransport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourTransportController extends Controller
{

    public function index($id_tour)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }
    
        $transports = $tour->transports()->get();
    
        return response()->json([
            'status' => 200,
            'tour' => $tour,
            'transports' => $transports,
        ]);
    }
 

 ///////////////////////////////////////////////////////// 


    public function addDistination(Request $request, $id_tour, $id_transport)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $transport = Transport::find($id_transport);
        if (!$transport) {
            return response()->json(['message' => "Transport with ID '{$id_transport}' not found"], 404);
        }

        $tour->transports()->attach($id_transport);

        return response()->json(['message' => "Transport '{$transport->nom}' added successfully"], 200);
    }


// ////////////////////////////////////


    public function removeDistination(Request $request, $id_tour, $id_transport)
    {
        $tour = Tour::find($id_tour);
        if (!$tour) {
            return response()->json(['message' => "Tour with ID '{$id_tour}' not found"], 404);
        }

        $transport = Transport::find($id_transport);
        if (!$transport) {
            return response()->json(['message' => "Transport with ID '{$id_transport}' not found"], 404);
        }

        $tour->transports()->detach($id_transport);

        return response()->json(['message' => "Transport '{$transport->nom}' removed successfully"], 200);
    }
}
