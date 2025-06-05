<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Modules\Taxido\Models\Zone;

class ZonaController extends Controller
{
    // Listar todas las zonas
    public function index()
    {
        $zonas = Zona::all();
        return response()->json($zonas);
    }

    // Crear nueva zona
    // public function store(Request $request)
    // {
    //     try {
    //         $zona = new Zona();
    //         $zona->name = $request->name;
    //         $zona->locations = $request->locations;
    //         $zona->amount = $request->amount;
    //         $zona->status = $request->status ?? 1;
    //         $zona->distance_type = $request->distance_type ?? 'mile';

    //         if ($request->place_points) {
    //             $zona->place_points = DB::raw("ST_GeomFromText('{$request->place_points}')");
    //         }

    //         $zona->save();

    //         return response()->json([
    //             'message' => 'Zona creada exitosamente.',
    //             'data' => $zona
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Error al crear la zona.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {
        try {
            $zona = new Zona();
            $zona->name = $request->name;
            $zona->locations = $request->locations;
            $zona->amount = $request->amount;
            $zona->status = $request->status ?? 1;
            $zona->distance_type = $request->distance_type ?? 'mile';

            $zona->save();

            if ($request->place_points) {
                DB::table('zonas')
                    ->where('id', $zona->id)
                    ->update([
                        'place_points' => DB::raw("ST_GeomFromText('{$request->place_points}')")
                    ]);
            }

            return response()->json([
                'message' => 'Zona creada exitosamente.',
                'data' => Zona::find($zona->id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la zona.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'name' => 'required|string',
    //             'locations' => 'required|array|min:1',
    //             'locations.*.lat' => 'required|numeric',
    //             'locations.*.lng' => 'required|numeric',
    //             'amount' => 'nullable|numeric',
    //             'distance_type' => 'in:mile,km',
    //         ]);

    //         $zona = new Zona();
    //         $zona->name = $request->name;
    //         $zona->locations = json_encode($request->locations); // guardar como string JSON
    //         $zona->amount = $request->amount;
    //         $zona->status = $request->status ?? 1;
    //         $zona->distance_type = $request->distance_type ?? 'mile';
    //         $zona->save();

    //         // Convertir locations a WKT y guardar en campo spatial
    //         $placePointsWKT = $this->convertLocationsToWKT($request->locations);
    //         DB::table('zonas')
    //             ->where('id', $zona->id)
    //             ->update([
    //                 'place_points' => DB::raw("ST_GeomFromText('$placePointsWKT')")
    //             ]);

    //         return response()->json([
    //             'message' => 'Zona creada exitosamente.',
    //             'data' => Zona::find($zona->id)
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Error al crear la zona.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    // Mostrar zona específica
    public function show($id)
    {
        try {
            $zona = DB::table('zonas')
                ->select(
                    'id',
                    'name',
                    'locations',
                    'amount',
                    'status',
                    'distance_type',
                    DB::raw('ST_AsText(place_points) as place_points_wkt')
                )
                ->where('id', $id)
                ->first();

            if (!$zona) {
                return response()->json([
                    'message' => 'Zona no encontrada.'
                ], 404);
            }

            $zona->locations = json_decode($zona->locations, true);

            if (!is_null($zona->amount)) {
                $zona->amount = (float) $zona->amount;
            }

            $zona->place_points = $this->parseMultiPointWKT($zona->place_points_wkt);

            unset($zona->place_points_wkt);

            return response()->json([
                'message' => 'Zona obtenida exitosamente.',
                'data' => $zona
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la zona.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function parseMultiPointWKT($wkt)
    {
        $points = [];

        $wkt = str_replace(['MULTIPOINT((', '))'], '', $wkt);

        $pairs = explode('),(', $wkt);

        foreach ($pairs as $pair) {
            $coords = explode(' ', trim($pair));
            if (count($coords) === 2) {
                $points[] = [
                    'lat' => (float) $coords[1],
                    'lng' => (float) $coords[0]
                ];
            }
        }

        return $points;
    }


   public function update(Request $request, $id)
{
    try {
        $zona = Zona::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'locations' => 'required|array|min:1',
            'locations.*.lat' => 'required|numeric',
            'locations.*.lng' => 'required|numeric',
            'amount' => 'required|numeric',
            'distance_type' => 'in:mile,km',
            'status' => 'nullable|in:1,0',
            'place_points' => 'nullable|string',
        ]);

        $zona->name = $request->name;
        $zona->locations = $request->locations;
        $zona->amount = $request->amount;
        $zona->status = $request->status ?? 1;
        $zona->distance_type = $request->distance_type ?? 'mile';

        $zona->save();

        if ($request->place_points) {
            DB::table('zonas')
                ->where('id', $zona->id)
                ->update([
                    'place_points' => DB::raw("ST_GeomFromText('{$request->place_points}')")
                ]);
        }

        return response()->json([
            'message' => 'Zona actualizada exitosamente.',
            'data' => Zona::find($zona->id)
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al actualizar la zona.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    // Eliminar zona (soft delete)
    public function destroy($id)
    {
        try {
            $zona = Zona::findOrFail($id);
            $zona->delete();

            return response()->json(['message' => 'Zona eliminada correctamente.']);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la zona.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Convertir locations a formato WKT
    private function convertLocationsToWKT(array $locations, string $type = 'MULTIPOINT'): string
    {
        $points = array_map(function ($loc) {
            return "{$loc['lng']} {$loc['lat']}";
        }, $locations);

        if ($type === 'POLYGON') {
            if ($points[0] !== end($points)) {
                $points[] = $points[0];
            }
            return 'POLYGON((' . implode(', ', $points) . '))';
        }

        return 'MULTIPOINT(' . implode(', ', $points) . ')';
    }


   public function checkLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $point = [
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];

        $zonas = Zona::where('status', 1)->get();

        foreach ($zonas as $zona) {
            if (is_array($zona->locations) && $this->isPointInPolygon($point, $zona->locations)) {
                return response()->json([
                    'inside' => true,
                    'zona_id' => $zona->id,
                    'zona_name' => $zona->name,
                    'amount' => $zona->amount,
                ]);
            }
        }

        return response()->json([
            'inside' => false,
            'message' => 'La ubicación no está dentro de ninguna zona registrada.',
        ]);
    }

    private function isPointInPolygon(array $point, array $polygon): bool
    {
        $x = $point['lng'];
        $y = $point['lat'];

        $inside = false;
        $n = count($polygon);
        for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
            $xi = $polygon[$i]['lng'];
            $yi = $polygon[$i]['lat'];
            $xj = $polygon[$j]['lng'];
            $yj = $polygon[$j]['lat'];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                         ($x < ($xj - $xi) * ($y - $yi) / (($yj - $yi) ?: 1e-10) + $xi);
            if ($intersect) {
                $inside = !$inside;
            }
        }

        return $inside;
    }
}
