<?php

namespace App\Http\Controllers;

use App\Models\VehicleGalery;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Exception;

class VehicleGaleryController extends Controller
{
    public function index()
    {
        return VehicleGalery::with(['driver', 'vehicle'])->get();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'soat_photo' => 'nullable|image|max:2048',
                'ci_photo' => 'nullable|image|max:2048',
                'address_voucher_photo' => 'nullable|image|max:2048',
                'matricula_photo' => 'nullable|image|max:2048',
                'driver_license_photo' => 'nullable|image|max:2048',
                'driver_id' => 'nullable|exists:users,id',
                'id_vehicle' => 'nullable|exists:vehicle_information,id',
            ]);

            $fields = [];

            foreach (['soat_photo', 'ci_photo', 'address_voucher_photo', 'matricula_photo', 'driver_license_photo'] as $field) {
                if ($request->hasFile($field)) {
                    $fields[$field] = $request->file($field)->store('vehicle_galeries', 'public');
                }
            }

            $fields['driver_id'] = $request->driver_id;
            $fields['id_vehicle'] = $request->id_vehicle;

            $galery = VehicleGalery::create($fields);
            return response()->json($galery, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error creating vehicle galery.'], 500);
        }
    }

    public function show($id)
    {
        try {
            return VehicleGalery::with(['driver', 'vehicle'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle galery not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $galery = VehicleGalery::findOrFail($id);

            $request->validate([
                'soat_photo' => 'nullable|image|max:2048',
                'ci_photo' => 'nullable|image|max:2048',
                'address_voucher_photo' => 'nullable|image|max:2048',
                'matricula_photo' => 'nullable|image|max:2048',
                'driver_license_photo' => 'nullable|image|max:2048',
                'driver_id' => 'nullable|exists:users,id',
                'id_vehicle' => 'nullable|exists:vehicle_information,id',
            ]);

            $fields = [];

            foreach (['soat_photo', 'ci_photo', 'address_voucher_photo', 'matricula_photo', 'driver_license_photo'] as $field) {
                if ($request->hasFile($field)) {
                    if ($galery->$field) {
                        Storage::disk('public')->delete($galery->$field);
                    }

                    $fields[$field] = $request->file($field)->store('vehicle_galeries', 'public');
                }
            }

            $fields['driver_id'] = $request->driver_id;
            $fields['id_vehicle'] = $request->id_vehicle;

            $galery->update($fields);
            return response()->json($galery);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle galery not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error updating vehicle galery.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $galery = VehicleGalery::findOrFail($id);

            foreach (['soat_photo', 'ci_photo', 'address_voucher_photo', 'matricula_photo', 'driver_license_photo'] as $field) {
                if ($galery->$field) {
                    Storage::disk('public')->delete($galery->$field);
                }
            }

            $galery->delete();
            return response()->json(['message' => 'Deleted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle galery not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting vehicle galery.'], 500);
        }
    }
}
