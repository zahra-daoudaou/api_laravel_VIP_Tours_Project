<?php

namespace App\Http\Controllers\API;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return response()->json([
            'status' => 200,
            'plans' => $plans,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_plan' => 'required|unique:plans|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $plan = Plan::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Plan created successfully!',
            'plan' => $plan,
        ], 200);
    }

    public function show($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 404,
                'message' => 'Plan not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'plan' => $plan,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 404,
                'message' => 'Plan not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom_plan' => 'unique:plans,nom_plan|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $plan->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'plan updated successfully!',
            'plan' => $plan,
        ], 200);
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 404,
                'message' => 'Plan not found!',
            ], 404);
        }

        $plan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Plan deleted successfully!',
        ], 200);
    }
}
