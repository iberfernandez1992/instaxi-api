<?php

namespace App\Http\Controllers;

use App\Models\VehicleInformation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class VehicleInformationController extends Controller
{
    public function index()
    {
        return VehicleInformation::with(['vehicleType', 'driver'])->get();
    }

    public function getByDriver($driver_id)
    {
        try {
            return VehicleInformation::where('driver_id', $driver_id)->get();
        } catch (Exception $e) {
            return response()->json(['error' => 'Error retrieving vehicles by driver.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'amb_per_dist_fees' => 'nullable|numeric',
                'plate_number' => 'nullable|string',
                'color' => 'nullable|string',
                'model' => 'nullable|string',
                'seat' => 'nullable|integer',
                'vehicle_type_id' => 'nullable|exists:vehicle_types,id',
                'driver_id' => 'nullable|exists:users,id',
            ]);

            $vehicle = VehicleInformation::create($data);
            return response()->json($vehicle, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error creating vehicle information.'], 500);
        }
    }

    public function show($id)
    {
        try {
            return VehicleInformation::with(['vehicleType', 'driver'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error retrieving vehicle information.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle = VehicleInformation::findOrFail($id);

            $data = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'amb_per_dist_fees' => 'nullable|numeric',
                'plate_number' => 'nullable|string',
                'color' => 'nullable|string',
                'model' => 'nullable|string',
                'seat' => 'nullable|integer',
                'vehicle_type_id' => 'nullable|exists:vehicle_types,id',
                'driver_id' => 'nullable|exists:users,id',
            ]);

            $vehicle->update($data);

            return response()->json($vehicle);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error updating vehicle information.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vehicle = VehicleInformation::findOrFail($id);
            $vehicle->delete();

            return response()->json(['message' => 'Deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting vehicle.'], 500);
        }
    }
}
