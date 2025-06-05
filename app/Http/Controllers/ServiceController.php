<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function indexActive()
{
    $services = Service::active()->get(); 
    return response()->json($services);
}

   
    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        return response()->json($service);
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'nullable|string',
            'type' => 'sometimes|in:taxi,paqueteria',
            'status' => 'nullable|integer|in:0,1',
            'is_primary' => 'nullable|integer|in:0,1',
            'created_by_id' => 'nullable|integer|exists:users,id',
            'service_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'service_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        if ($request->hasFile('service_image')) {
            $imagePath = $request->file('service_image')->store('services/images', 'public');
            $validated['service_image'] = $imagePath;
        }

        if ($request->hasFile('service_icon')) {
            $iconPath = $request->file('service_icon')->store('services/icons', 'public');
            $validated['service_icon'] = $iconPath;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $service = Service::create($validated);

        return response()->json(['message' => 'Servicio creado', 'service' => $service], 201);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al crear el servicio', 'error' => $e->getMessage()], 500);
    }
}

public function update(Request $request, $id)
{
   
    try {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $id,
            'description' => 'nullable|string',
            'type' => 'sometimes|in:taxi,paqueteria',
            'status' => 'nullable|integer|in:0,1',
            'is_primary' => 'nullable|integer|in:0,1',
            'created_by_id' => 'nullable|integer|exists:users,id',
            'service_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'service_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        if ($request->hasFile('service_image')) {
            if ($service->service_image) {
                Storage::disk('public')->delete($service->service_image);
            }
            $imagePath = $request->file('service_image')->store('services/images', 'public');
            $validated['service_image'] = $imagePath;
        }

        if ($request->hasFile('service_icon')) {
            if ($service->service_icon) {
                Storage::disk('public')->delete($service->service_icon);
            }
            $iconPath = $request->file('service_icon')->store('services/icons', 'public');
            $validated['service_icon'] = $iconPath;
        }

        if (!empty($validated['name']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $service->update($validated);

        return response()->json(['message' => 'Servicio actualizado', 'service' => $service]);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar el servicio', 'error' => $e->getMessage()], 500);
    }
}

public function destroy($id)
{
    try {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        if ($service->service_image) {
            Storage::disk('public')->delete($service->service_image);
        }
        if ($service->service_icon) {
            Storage::disk('public')->delete($service->service_icon);
        }

        $service->delete();

        return response()->json(['message' => 'Servicio eliminado']);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar el servicio', 'error' => $e->getMessage()], 500);
    }
}

}
