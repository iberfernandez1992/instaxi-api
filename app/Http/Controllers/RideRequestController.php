<?php

namespace App\Http\Controllers;

use App\Models\RideRequest;
use Illuminate\Http\Request;
use Exception;

class RideRequestController extends Controller
{
    public function index()
    {
        try {
            $rides = RideRequest::all();

            return response()->json([
                'success' => true,
                'message' => 'Ride requests retrieved successfully.',
                'data' => $rides
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve ride requests.',
                'data' => null
            ], 500);
        }
    }

public function store(Request $request)
{
    try {
        $data = $request->validate([
            'rider_id' => 'required|exists:users,id',
            'service_id' => 'nullable|integer',
            'vehicle_type_id' => 'nullable|integer',
            'service_category_id' => 'nullable|integer',
            'locations' => 'nullable|array',
            'location_coordinates' => 'nullable|array',
            'duration' => 'nullable|string',
            'distance' => 'nullable|string',
            'distance_unit' => 'nullable|string',
            'ride_fare' => 'nullable|numeric',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'created_by_id' => 'nullable|exists:users,id',
        ]);

        $data['status'] = 'pending';

        $ride = RideRequest::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Ride request created successfully.',
            'data' => $ride
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create ride request.',
            'error' => $e->getMessage(), 
            'data' => null
        ], 500);
    }
}



    public function show(RideRequest $rideRequest)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Ride request retrieved successfully.',
                'data' => $rideRequest
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve ride request.',
                'data' => null
            ], 500);
        }
    }

  public function update(Request $request, RideRequest $rideRequest)
{
    try {
        $data = $request->validate([
            'rider_id' => 'sometimes|exists:users,id',
            'service_id' => 'sometimes|nullable|integer',
            'vehicle_type_id' => 'sometimes|nullable|integer',
            'service_category_id' => 'sometimes|nullable|integer',
            'locations' => 'sometimes|nullable|array',
            'location_coordinates' => 'sometimes|nullable|array',
            'duration' => 'sometimes|nullable|string',
            'distance' => 'sometimes|nullable|string',
            'distance_unit' => 'sometimes|nullable|string',
            'ride_fare' => 'sometimes|nullable|numeric',
            'description' => 'sometimes|nullable|string',
            'start_time' => 'sometimes|nullable|date',
            'end_time' => 'sometimes|nullable|date',
            'created_by_id' => 'sometimes|nullable|exists:users,id',
            'status' => 'sometimes|in:pending,accepted,completed,cancelled', 
        ]);

        $rideRequest->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Ride request updated successfully.',
            'data' => $rideRequest
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update ride request.',
            'data' => null
        ], 500);
    }
}


    public function destroy(RideRequest $rideRequest)
    {
        try {
            $rideRequest->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ride request deleted successfully.',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ride request.',
                'data' => null
            ], 500);
        }
    }
}
