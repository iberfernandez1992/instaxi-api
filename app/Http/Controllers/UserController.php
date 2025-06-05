<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $fields = $request->validate([
            'name' => 'sometimes|string',
            'username' => 'sometimes|string|unique:users,username,' . $user->id,
            'country_code' => 'sometimes|string|nullable',
            'phone' => 'sometimes|string|nullable',
            'profile_image_id' => 'sometimes|numeric|nullable',
            'location' => 'sometimes|array|nullable',
            'fcm_token' => 'sometimes|string|nullable',
            'lat' => 'sometimes|numeric|nullable', 
            'lng' => 'sometimes|numeric|nullable',  
        ]);

        $user->update($fields);

        return response()->json(['message' => 'Perfil actualizado', 'user' => $user]);
    }

    // Cambiar contraseña
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        $user = $request->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'La contraseña actual es incorrecta'], 403);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }

    // Eliminar usuario (soft delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}