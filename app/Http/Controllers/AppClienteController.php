<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AppClienteController extends Controller
{
   public function login(Request $request)
{
    try {
        $fields = $request->validate([
            'phone' => 'required|string',
            'role' => 'required|string|in:rider',
        ]);

        $user = User::where('phone', $fields['phone'])
                    ->where('role', $fields['role'])
                    ->first();

        return response()->json([
            'usuario_verificado' => $user ? true : false,
            'message' => $user ? 'Usuario encontrado.' : 'Usuario no encontrado.',
            'user' => $user,
        ], 200);

    } catch (QueryException $e) {
        return response()->json([
            'usuario_verificado' => false,
            'message' => 'Error en la base de datos: ' . $e->getMessage(),
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'usuario_verificado' => false,
            'message' => 'Error inesperado: ' . $e->getMessage(),
        ], 500);
    }
}

   public function verificarCredenciales(Request $request)
{
    try {
        $fields = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|in:rider',
        ]);

        $user = User::where('phone', $fields['phone'])
                    ->where('role', $fields['role'])
                    ->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'usuario_autenticado' => false,
                'message' => 'Credenciales inválidas.',
            ], 200);
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        return response()->json([
            'usuario_autenticado' => true,
            'message' => 'Inicio de sesión exitoso.',
            'user' => $user,
            'token' => $token,
        ], 200);

    } catch (QueryException $e) {
        return response()->json([
            'usuario_autenticado' => false,
            'message' => 'Error en la base de datos: ' . $e->getMessage(),
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'usuario_autenticado' => false,
            'message' => 'Error inesperado: ' . $e->getMessage(),
        ], 500);
    }
}

}
