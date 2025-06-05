<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|email|unique:users,email',
                'country_code' => 'nullable|string',
                'phone' => 'nullable|string|unique:users,phone',
                'password' => 'required|string|confirmed',
                'profile_image_id' => 'nullable|numeric',
                'referral_code' => 'nullable|string',
                'fcm_token' => 'nullable|string',
                'location' => 'nullable|array',
                'service_id' => 'nullable|numeric',
                'service_category_id' => 'nullable|numeric',
                'role' => 'nullable|string|in:admin,rider,driver',
            ]);

            $user = User::create([
                'name' => $fields['name'],
                'username' => $fields['username'],
                'email' => $fields['email'],
                'country_code' => $fields['country_code'] ?? null,
                'phone' => $fields['phone'] ?? null,
                'password' => bcrypt($fields['password']),
                'profile_image_id' => $fields['profile_image_id'] ?? null,
                'referral_code' => $fields['referral_code'] ?? null,
                'fcm_token' => $fields['fcm_token'] ?? null,
                'location' => $fields['location'] ?? null,
                'role' => $fields['role'] ?? 'rider',
                'service_id' => $fields['service_id'] ?? null,
                'service_category_id' => $fields['service_category_id'] ?? null,
                'is_verified' => false,
                'status' => 1,
                'is_online' => 0,
                'is_on_ride' => 0,
            ]);

            $token = $user->createToken('apptoken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la base de datos: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $fields['email'])->first();

            if (!$user || !Hash::check($fields['password'], $user->password)) {
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }

            $token = $user->createToken('apptoken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json(['message' => 'Sesión cerrada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }
}
