<?php

namespace App\Traits;

use App\Models\Notificacion;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Env;

trait Socketio
{
    
    // private $path = 'http://localhost:3220/';
    private $path = 'https://socket.naudi-bolivia.com/';

    public function emmitByGet($resource) {
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_URL, $this->path.$resource);
        curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($crl);
        curl_close($crl);
        return $response;
    }

    private function emmitByPost($resource, $data = null)
    {
        try {
            $url = $this->path.$resource;
            $ch = curl_init($url);

            $jsonBody = json_encode([
                'data' => json_encode($data),
            ]);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonBody)
            ));

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new \Exception('Error: ' . curl_error($ch));
            }
            curl_close($ch);
            $dataResponse = json_decode($response, true);
            return json_decode($dataResponse['data'], true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
