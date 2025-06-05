<?php

namespace App\Http\Controllers;

use App\Models\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use App\Models\User;

class CustomNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Mostrar todas las notificaciones del usuario autenticado.
     */
    public function index()
    {
        $notifications = CustomNotification::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereNull('user_id');
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    /**
     * Guardar una nueva notificación y enviarla a usuarios por rol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'type' => 'required|in:driver,rider',
            'data' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $notification = CustomNotification::create($validated);

        $tokens = \App\Models\User::where('role', $validated['type'])
            ->whereNotNull('fcm_token')
            ->pluck('fcm_token')
            ->toArray();

        $resultado = [];

        if (!empty($tokens)) {
            // Enviar notificación si hay tokens
            $resultado = $this->notificationService->enviarNotificacionesMultiples(
                $tokens,
                $validated['name'], 
                $validated['data'], 
                [
                    'dataId' => $notification->id,
                    'urlDestino' => '',
                    'accion' => ''
                ]
            );
        } else {
            // Si no hay tokens, devolver mensaje informativo
            $resultado = ['info' => 'No se encontraron tokens para usuarios del tipo: ' . $validated['type']];
        }

        return response()->json([
            'message' => 'Notificación creada.',
            'resultadosEnvio' => $resultado,
            'notification' => $notification,
        ], 201);
    }


    /**
     * Eliminar una notificación por ID si pertenece al usuario.
     */
    public function destroy($id)
    {
        $notification = CustomNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notificación eliminada']);
    }
}
