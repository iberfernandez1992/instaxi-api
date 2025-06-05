<?php

namespace App\Http\Controllers;

use App\Models\DirectionRider;
use Illuminate\Http\Request;

class DirectionRiderController extends Controller
{
    public function index()
    {
        return DirectionRider::with('rider')->get();
    }

    public function byRider($id)
{
    return DirectionRider::with('rider')->where('id_rider', $id)->get();
}

 public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string',
        'direccion' => 'required|string',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'id_rider' => 'required|exists:users,id',
    ]);

    $rider = \App\Models\User::where('id', $validated['id_rider'])
                              ->where('role', 'rider')
                              ->first();

    if (!$rider) {
        return response()->json([
            'message' => 'El ID proporcionado no corresponde a un rider válido.'
        ], 422);
    }

    return DirectionRider::create($validated);
}


    public function show(DirectionRider $directionRider)
    {
        return $directionRider->load('driver');
    }

    public function update(Request $request, DirectionRider $directionRider)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string',
                    'direccion' => 'required|string',

            'lat' => 'sometimes|numeric',
            'lng' => 'sometimes|numeric',
            'id_rider' => 'sometimes|exists:users,id',
        ]);

        $directionRider->update($validated);

        return $directionRider;
    }

   public function destroy($id)
{
    $directionRider = DirectionRider::find($id);

    if (!$directionRider) {
        return response()->json(['message' => 'Dirección no encontrada'], 404);
    }

    $directionRider->delete();

    return response()->json(['message' => 'Eliminado correctamente']);
}

}
