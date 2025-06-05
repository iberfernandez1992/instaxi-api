<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Validator;

class NotificationService
{
    protected $messaging;

    public function __construct()
    {
        $archivoCredenciales = storage_path('taxidouser-82b11-firebase-adminsdk-fbsvc-3e1093d88c.json');

        $this->messaging = (new Factory)
            ->withServiceAccount($archivoCredenciales)
            ->createMessaging();
    }

    /**
     * Envía una notificación push a un token FCM.
     */
    public function enviarNotificacion($tokenDispositivo, $titulo, $mensaje, $datosExtra = [])
    {
        // Validar entradas
        $validator = Validator::make([
            'tokenDispositivo' => $tokenDispositivo,
            'titulo' => $titulo,
            'mensaje' => $mensaje,
        ], [
            'tokenDispositivo' => 'required|string',
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return [
                'error' => 'Datos inválidos',
                'detalles' => $validator->errors(),
            ];
        }

        // Construir carga útil adicional
        $dataPayload = [
            'dataId' => $datosExtra['dataId'] ?? '',
            'urlDestino' => $datosExtra['urlDestino'] ?? '',
            'accion' => $datosExtra['accion'] ?? '',
        ];

        try {
            $message = CloudMessage::new()
                ->withNotification(Notification::create($titulo, $mensaje))
                ->withData($dataPayload)
                ->withChangedTarget('token', $tokenDispositivo); // ✅ Método correcto, aunque es un alias interno de `toToken`

            $this->messaging->send($message);

            return ['message' => 'Notificación enviada correctamente'];
        } catch (\Throwable $e) {
            return [
                'error' => 'Error al enviar notificación',
                'mensaje' => $e->getMessage(),
                'linea' => $e->getLine(),
            ];
        }
    }

    public function enviarNotificacionesMultiples(array $tokens, string $titulo, string $mensaje, array $datosExtra = [])
{
    if (empty($tokens)) {
        return ['error' => 'No hay tokens para enviar notificaciones.'];
    }

    $dataPayload = [
        'dataId' => $datosExtra['dataId'] ?? '',
        'urlDestino' => $datosExtra['urlDestino'] ?? '',
        'accion' => $datosExtra['accion'] ?? '',
    ];

    $baseMessage = CloudMessage::new()
        ->withNotification(Notification::create($titulo, $mensaje))
        ->withData($dataPayload);

    $messages = [];
    foreach ($tokens as $token) {
        $messages[] = $baseMessage->withChangedTarget('token', $token);
    }

    try {
        $report = $this->messaging->sendAll($messages);

        return [
            'successes' => $report->successes()->count(),
            'failures' => $report->failures()->count(),
        ];
    } catch (\Throwable $e) {
        return [
            'error' => 'Error al enviar notificaciones múltiples',
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
        ];
    }
}
}
