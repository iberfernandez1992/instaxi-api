<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('role', 'driver')->get();
        return response()->json($drivers);
    }

      public function update(Request $request, $id)
    {
        try {
            $rider = User::where('id', $id)->where('role', 'driver')->first();

            if (!$rider) {
                return response()->json(['message' => 'Driver no encontrado'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'country_code' => 'sometimes|string|max:10',
                'phone' => 'sometimes|string|max:20',
                'password' => 'nullable|string|min:6|confirmed',
                'profile_image_id' => 'sometimes|nullable|integer',
                'is_verified' => 'sometimes|boolean',
                'status' => 'sometimes|in:0,1,2', 
                'referral_code' => 'sometimes|string|max:20',
                'fcm_token' => 'sometimes|nullable|string',
                'is_online' => 'sometimes|boolean',
                'is_on_ride' => 'sometimes|boolean',
                'location' => 'sometimes|nullable|string',
                'service_id' => 'sometimes|nullable|integer',
                'role' => 'sometimes|string|in:rider,driver,admin',
            ]);

            if (!empty($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']);
            }

            $rider->update($validated);

            return response()->json([
                'message' => 'Rider actualizado correctamente',
                'rider' => $rider
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error inesperado al actualizar el rider',
                'error' => $e->getMessage()
            ], 500);
        }
    }

      public function show($id)
    {
        try {
            $rider = User::where('id', $id)->where('role', 'rider')->first();

            if (!$rider) {
                return response()->json(['message' => 'Rider no encontrado'], 404);
            }

            return response()->json($rider, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el rider',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}