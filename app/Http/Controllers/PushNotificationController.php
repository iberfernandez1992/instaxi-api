<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\NotificationService;

class PushNotificationController extends Controller
{
    // public function sendPushNotification()
    // {
    //     // $firebase = (new Factory)->withServiceAccount(__DIR__.’/../../../config/firebase_credentials.json’);

    //     $messaging = $firebase->createMessaging();

    //     $message = CloudMessage::fromArray([
    //         'notification' => [
    //             'title' => 'Hello from Firebase!',
    //             'body' => 'This is a test notification.'
    //         ],
    //         'topic' => 'global'
    //     ]);

    //     $messaging->send($message);

    //     return response()->json(['message' => 'Push notification sent successfully']);
    // }


    private $NotificationService;    

    public function __construct(NotificationService $notifications){
            $this->NotificationService = $notifications;
    }


    public function enviarNotificaciones(Request $request){

         $tokenDispositivo = $request->input('tokenDispositivo');
        $titulo = $request->input('titulo');
        $mensaje = $request->input('mensaje');
        $datosExtra = [
            'dataId' => '1234',
            'urlDestino' => '',
            'accion' => ''
        ];

        
        $result = $this->NotificationService->enviarNotificacion($tokenDispositivo, $titulo, $mensaje, $datosExtra);

        return response()->json($result);
    }

}