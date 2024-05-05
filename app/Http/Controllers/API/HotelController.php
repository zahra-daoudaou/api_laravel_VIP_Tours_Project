<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json([
            'status' => 200,
            'Hotel' => $hotels,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:hotels|string',
            'email' => 'required|string',
            'num_tel' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'adress' => 'required|string',
            'nbr_etoile' => 'required|integer|max:5',
            'logo' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $hotel = Hotel::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Hotel created successfully!',
            'Hotel' => $hotel,
        ], 200);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                'status' => 404,
                'message' => 'Hotel not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'Hotel' => $hotel,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                'status' => 404,
                'message' => 'Hotel not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'unique:hotels|string',
            'email' => 'string',
            'num_tel' => 'string',
            'ville' => 'string',
            'pays' => 'string',
            'adress' => 'string',
            'nbr_etoile' => 'integer|max:5',
            'logo' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $hotel->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Hotel updated successfully!',
            'Hotel' => $hotel,
        ], 200);
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                'status' => 404,
                'message' => 'Hotel not found!',
            ], 404);
        }

        $hotel->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Hotel deleted successfully!',
        ], 200);
    }
}