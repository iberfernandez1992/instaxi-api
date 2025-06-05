<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::with(['service', 'serviceCategory'])->get();
        return response()->json($vehicleTypes);
    }

public function getByService($serviceId)
{
    $vehicleTypes = ServiceCategory::where('service_id', $serviceId)
                                   ->where('status', 1)
                                   ->get();

    return response()->json($vehicleTypes);
}

public function getByServiceCategory($serviceId)
{
    $vehicleTypes = VehicleType::where('service_category_id', $serviceId)
                                   ->where('status', 1)
                                   ->get();

    return response()->json($vehicleTypes);
}

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:191|unique:vehicle_types,slug',
                'service_id' => 'nullable|integer',
                'service_category_id' => 'nullable|integer',
                'status' => 'nullable|integer|in:0,1',
                'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'vehicle_map_icon' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($request->hasFile('vehicle_image')) {
                $path = $request->file('vehicle_image')->store('vehicle_images', 'public');
                $validated['vehicle_image'] = $path;
            }

            if ($request->hasFile('vehicle_map_icon')) {
                $path = $request->file('vehicle_map_icon')->store('vehicle_map_icons', 'public');
                $validated['vehicle_map_icon'] = $path;
            }

            if (empty($validated['slug']) && !empty($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $vehicleType = VehicleType::create($validated);

            return response()->json(['message' => 'Tipo de vehículo creado', 'vehicle_type' => $vehicleType], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear tipo de vehículo', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $vehicleType = VehicleType::find($id);
        if (!$vehicleType) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($vehicleType);
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicleType = VehicleType::find($id);
            if (!$vehicleType) return response()->json(['message' => 'No encontrado'], 404);

            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:191|unique:vehicle_types,slug,' . $id,
                'service_id' => 'nullable|integer',
                'service_category_id' => 'nullable|integer',
                'status' => 'nullable|integer|in:0,1',
                'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'vehicle_map_icon' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($request->hasFile('vehicle_image')) {
                if ($vehicleType->vehicle_image_id) {
                    Storage::disk('public')->delete($vehicleType->vehicle_image_id);
                }
                $validated['vehicle_image'] = $request->file('vehicle_image')->store('vehicle_images', 'public');
            }

            if ($request->hasFile('vehicle_map_icon')) {
                if ($vehicleType->vehicle_map_icon_id) {
                    Storage::disk('public')->delete($vehicleType->vehicle_map_icon_id);
                }
                $validated['vehicle_map_icon'] = $request->file('vehicle_map_icon')->store('vehicle_map_icons', 'public');
            }

            if (!empty($validated['name']) && empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $vehicleType->update($validated);

            return response()->json(['message' => 'Actualizado', 'vehicle_type' => $vehicleType]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar tipo de vehículo', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vehicleType = VehicleType::find($id);
            if (!$vehicleType) return response()->json(['message' => 'No encontrado'], 404);

            if ($vehicleType->vehicle_image_id) {
                Storage::disk('public')->delete($vehicleType->vehicle_image_id);
            }

            if ($vehicleType->vehicle_map_icon_id) {
                Storage::disk('public')->delete($vehicleType->vehicle_map_icon_id);
            }

            $vehicleType->delete();

            return response()->json(['message' => 'Eliminado']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar tipo de vehículo', 'error' => $e->getMessage()], 500);
        }
    }
}
