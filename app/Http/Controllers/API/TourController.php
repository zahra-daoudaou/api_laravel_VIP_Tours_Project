<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;
//use Carbon\Carbon;


class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return response()->json([
            'status' => 200,
            'Tours' => $tours,
        ]);
    }

    public function store(Request $request)
{
    /*
    $date_debut = Carbon::createFromFormat('d-m-Y', $request->date_debut)->format('Y-m-d');
    $date_fin = Carbon::createFromFormat('d-m-Y', $request->date_fin)->format('Y-m-d');
    */
    $validator = Validator::make($request->all(), [
        'titre' => 'required|string',
        'description' => 'required|string',
        'prix' => 'required|numeric',
        'date_debut' => 'required',
        'date_fin' => 'required',         
    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ], 422);
    }

    $tour = Tour::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'prix' => $request->prix,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Tour created successfully!',
        'Tour' => $tour,
    ], 200);
}


    public function show($id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            return response()->json([
                'status' => 404,
                'message' => 'Tour not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'Tour' => $tour,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::find($id);
    
        if (!$tour) {
            return response()->json([
                'status' => 404,
                'message' => 'Tour not found!',
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'titre' => 'string',
            'description' => 'string',
            'prix' => 'numeric',
            
        ]);
    
        /*
        'date_debut',
        'date_fin',
        date_format:d-m-Y
        */

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
    
        $data = $request->all();
        /*
        $data['date_debut'] = Carbon::createFromFormat('d-m-Y', $request->date_debut)->format('Y-m-d');
        $data['date_fin'] = Carbon::createFromFormat('d-m-Y', $request->date_fin)->format('Y-m-d');
        */

        $tour->update($data);
    
        return response()->json([
            'status' => 200,
            'message' => 'Tour updated successfully!',
            'Tour' => $tour,
        ], 200);
    }
    

    public function destroy($id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            return response()->json([
                'status' => 404,
                'message' => 'Tour not found!',
            ], 404);
        }

        $tour->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Tour deleted successfully!',
        ], 200);
    }
}
