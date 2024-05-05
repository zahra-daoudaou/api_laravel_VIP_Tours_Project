<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transport;
use Illuminate\Support\Facades\Validator;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::all();
        return response()->json([
            'status' => 200,
            'Transports' => $transports,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:transports|string',
            'type_transport' => 'required|string',
            'email' => 'required|string',
            'num_tel' => 'required|integer',
            'logo' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $transport = Transport::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Transport created successfully!',
            'Transport' => $transport,
        ], 200);
    }

    public function show($id)
    {
        $transport = Transport::find($id);

        if (!$transport) {
            return response()->json([
                'status' => 404,
                'message' => 'Transport not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'Transport' => $transport,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transport = Transport::find($id);

        if (!$transport) {
            return response()->json([
                'status' => 404,
                'message' => 'Transport not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'unique:transports|string',
            'type_transport' => 'string',
            'email' => 'string',
            'num_tel' => 'integer',
            'logo' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $transport->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Transport updated successfully!',
            'Transport' => $transport,
        ], 200);
    }

    public function destroy($id)
    {
        $transport = Transport::find($id);

        if (!$transport) {
            return response()->json([
                'status' => 404,
                'message' => 'Transport not found!',
            ], 404);
        }

        $transport->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transport deleted successfully!',
        ], 200);
    }
}