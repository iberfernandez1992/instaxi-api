<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('service')->get();
        return response()->json($categories);
    }

    public function getActiveCategories()
{
    $categories = ServiceCategory::with('service')
        ->where('status', 1)
        ->get();



    return response()->json($categories);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_categories,slug',
            'type' => 'nullable|string|max:255',
            'service_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
            'created_by_id' => 'nullable|exists:users,id',
            'service_category_image_id' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('service_category_image_id')) {
            $path = $request->file('service_category_image_id')->store('service_category_images', 'public');
            $validated['service_category_image_id'] = $path;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category = ServiceCategory::create($validated);

        return response()->json(['message' => 'Categoría creada', 'category' => $category], 201);
    }

    public function show($id)
    {
        $category = ServiceCategory::find($id);
        if (!$category) return response()->json(['message' => 'Categoría no encontrada'], 404);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = ServiceCategory::find($id);
        if (!$category) return response()->json(['message' => 'Categoría no encontrada'], 404);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_categories,slug,' . $id,
            'type' => 'nullable|string|max:255',
            'service_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
            'created_by_id' => 'nullable|exists:users,id',
            'service_category_image_id' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('service_category_image_id')) {
            if ($category->service_category_image_id) {
                Storage::disk('public')->delete($category->service_category_image_id);
            }

            $path = $request->file('service_category_image_id')->store('service_category_images', 'public');
            $validated['service_category_image_id'] = $path;
        }

        if (!empty($validated['name']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return response()->json(['message' => 'Categoría actualizada', 'category' => $category]);
    }

    public function destroy($id)
    {
        $category = ServiceCategory::find($id);
        if (!$category) return response()->json(['message' => 'Categoría no encontrada'], 404);

        if ($category->service_category_image_id) {
            Storage::disk('public')->delete($category->service_category_image_id);
        }

        $category->delete();

        return response()->json(['message' => 'Categoría eliminada']);
    }
    public function getByServiceId($serviceId)
    {
        $categories = ServiceCategory::where('service_id', $serviceId)
            ->where('status', 1)
            ->get();

        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No se encontraron categorías activas para este servicio'], 404);
        }

        return response()->json($categories);
    }
}
