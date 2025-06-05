<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'values' => 'required|array',
            ]);

            $setting = Setting::create([
                'values' => $validated['values'],
            ]);

            return response()->json([
                'message' => 'Configuración creada correctamente',
                'setting' => $setting,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error al crear configuración: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al crear la configuración',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $setting = Setting::findOrFail($id);
            return response()->json($setting);
        } catch (\Exception $e) {
            Log::error('Error al obtener configuración: ' . $e->getMessage());

            return response()->json([
                'message' => 'Configuración no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'values' => 'required|array',
               
            ]);

            $setting = Setting::findOrFail($id);
            $setting->update(['values' => $validated['values']]);

            return response()->json([
                'message' => 'Configuración actualizada correctamente',
                'setting' => $setting
            ]);

        } catch (\Exception $e) {
            Log::error('Error al actualizar configuración: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al actualizar la configuración',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $setting = Setting::findOrFail($id);
            $setting->delete();

            return response()->json([
                'message' => 'Configuración eliminada correctamente'
            ], 204);

        } catch (\Exception $e) {
            Log::error('Error al eliminar configuración: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error al eliminar la configuración',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
