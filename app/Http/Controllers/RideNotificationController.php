<?php
namespace App\Http\Controllers;

use App\Models\RideRequest;
use App\Models\User;
use App\Models\RideRequestDriver;
use App\Models\RideRequestNotification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class RideNotificationController extends Controller
{
    protected $notifier;

    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }

    public function notifyNearbyDrivers($rideRequestId)
    {
        $ride = RideRequest::findOrFail($rideRequestId);
        $coords = $ride->location_coordinates[0]; 

        $lat = $coords['lat'];
        $lng = $coords['lng'];
        $radioKm = 40;

        $drivers = User::selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance", [$lat, $lng, $lat])
            ->where('is_online', true)
            ->where('role', 'driver')
            ->having("distance", "<", $radioKm)
            ->get();

        $tokens = [];
        foreach ($drivers as $driver) {
            if ($driver->fcm_token) {
                $tokens[] = $driver->fcm_token;

                // Registrar en la tabla intermedia
                RideRequestNotification::create([
                    'ride_request_id' => $ride->id,
                    'driver_id' => $driver->id,
                    'status' => 'pending',
                    'notified_at' => Carbon::now(),
                    'fcm_token_snapshot' => $driver->fcm_token,
                    'device_type' => $driver->device_type ?? null,
                ]);
            }
        }

        if (!empty($tokens)) {
            $this->notifier->enviarNotificacionesMultiples(
                $tokens,
                'Nueva solicitud cercana',
                'Un pasajero necesita un viaje cercano.',
                [
                    'dataId' => $ride->id,
                    'accion' => 'ver_solicitud',
                    'urlDestino' => '/ride/details/' . $ride->id
                ]
            );
        }

        return response()->json(['message' => 'Notificaciones enviadas a conductores cercanos.']);
    }

     public function getDriverOffers($rideRequestId)
    {
        $ride = RideRequest::findOrFail($rideRequestId);

        $offers = RideRequestNotification::with('driver')
            ->where('ride_request_id', $ride->id)
            ->where('status', 'offered')
            ->get()
            ->map(function ($offer) {
                return [
                    'notification_id' => $offer->id,
                    'driver_id' => $offer->driver_id,
                    'driver_name' => $offer->driver->name ?? 'N/A',
                    'driver_rating' => $offer->driver->rating ?? null,
                    'vehicle' => $offer->driver->vehicle_name ?? null,
                    'price_offer' => $offer->price_offer ?? null,
                    'device_type' => $offer->device_type,
                    'responded_at' => $offer->responded_at,
                ];
            });

        return response()->json([
            'ride_id' => $ride->id,
            'offers' => $offers
        ]);
    }
}
