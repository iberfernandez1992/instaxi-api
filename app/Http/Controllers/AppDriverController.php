<?php


namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

use App\Models\VehicleInformation;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AppDriverController extends Controller
{
    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'phone' => 'required|string',
                'role' => 'required|string|in:driver',
            ]);

            $user = User::where('phone', $fields['phone'])
                ->where('role', $fields['role'])
                ->first();

            return response()->json([
                'usuario_verificado' => $user ? true : false,
                'message' => $user ? 'Conductor encontrado.' : 'Conductor no encontrado.',
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
                'role' => 'required|string|in:driver',
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

    public function indexActive()
        {
            $services = Service::active()->get(); 
            return response()->json($services);
        }

            public function indexVehicle()
    {
        $vehicleTypes = VehicleType::with(['service', 'serviceCategory'])->get();
        return response()->json($vehicleTypes);
    }

       public function getByService($serviceId)
    {
        $vehicleTypes = ServiceCategory::where('service_id', $serviceId)->get();
        return response()->json($vehicleTypes);
    }

       public function storeVehicle(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'nullable|string',
                'description' => 'nullable|string',
                'amb_per_dist_fees' => 'nullable|numeric',
                'plate_number' => 'nullable|string',
                'color' => 'nullable|string',
                'model' => 'nullable|string',
                'seat' => 'nullable|integer',
                'vehicle_type_id' => 'nullable|exists:vehicle_types,id',
                'driver_id' => 'nullable|exists:users,id',
            ]);

            $vehicle = VehicleInformation::create($data);
            return response()->json($vehicle, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error creating vehicle information.'], 500);
        }
    }

}
