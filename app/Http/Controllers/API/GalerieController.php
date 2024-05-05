<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Galerie;
use Illuminate\Support\Facades\Validator;

class GalerieController extends Controller
    {
        public function index()
        {
            $galeries = Galerie::all();
            return response()->json([
                'status' => 200,
                'galeries' => $galeries,
            ]);
        }
    
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'chemain_photo' => 'required|string',
                'date_publication' => 'required|date',
                'id_guide' => 'required|integer|exists:guides,id_guide|unique:galeries',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }
    
            $galerie = Galerie::create($request->all());
    
            return response()->json([
                'status' => 200,
                'message' => 'Galerie created successfully!',
                'galerie' => $galerie,
            ], 200);
        }
    
        public function show($id)
        {
            $galerie = Galerie::find($id);
    
            if (!$galerie) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Galerie not found!',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'galerie' => $galerie,
            ], 200);
        }
    
        public function update(Request $request, $id)
        {
            $galerie = Galerie::find($id);
    
            if (!$galerie) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Galerie not found!',
                ], 404);
            }
    
            $validator = Validator::make($request->all(), [
                'chemain_photo' => '|string',
                'date_publication' => 'date',
                'id_guide' => 'integer|exists:guides,id_guide|unique:galeries',
            ]);
           
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }
    
            $galerie->update($request->all());
    
            return response()->json([
                'status' => 200,
                'message' => 'Galerie updated successfully!',
                'galerie' => $galerie,
            ], 200);
        }
    
        public function destroy($id)
        {
            $galerie = Galerie::find($id);
    
            if (!$galerie) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Galerie not found!',
                ], 404);
            }
    
            $galerie->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Galerie deleted successfully!',
            ], 200);
        }
    }
    