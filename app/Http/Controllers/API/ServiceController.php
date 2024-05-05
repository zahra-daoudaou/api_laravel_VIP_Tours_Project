<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'status' => 200,
            'services' => $services,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'etat_service' => 'required|integer',
            'id_tour' => 'required|integer|exists:tours,id_tour',
            'id_plan' => 'required|integer|exists:plans,id_plan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $service = Service::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Service created successfully!',
            'Service' => $service,
        ], 200);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 404,
                'message' => 'Service not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'service' => $service,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 404,
                'message' => 'Service not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom_plan' => 'unique:plans|string',
            'nom' => 'string',
            'prix' => 'numeric',
            'etat_service' => 'integer',
            'id_tour' => 'integer|unique:tours',
            'id_plan' => 'integer|exists:services,id_service|unique:plans',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $service->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'service updated successfully!',
            'service' => $service,
        ], 200);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'status' => 404,
                'message' => 'Service not found!',
            ], 404);
        }

        $service->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Service deleted successfully!',
        ], 200);
    }
}