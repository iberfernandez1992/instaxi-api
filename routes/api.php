<?php

use App\Http\Controllers\AppClienteController;
use App\Http\Controllers\AppDriverController;
use App\Http\Controllers\CustomNotificationController;
use App\Http\Controllers\DirectionRiderController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VehicleGaleryController;
use App\Http\Controllers\VehicleInformationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\ZonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RideNotificationController;
use App\Http\Controllers\RideRequestController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Rutas públicas y protegidas con mejor organización.
*/

// RUTAS PÚBLICAS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



//Rutas para aplicacion Cliente
Route::prefix('session-cliente')->group(function () {
    Route::post('/login-password', [AppClienteController::class, 'verificarCredenciales']);
    Route::post('/login', [AppClienteController::class, 'login']);
});

Route::prefix('app-driver')->group(function () {
    Route::get('/vehicle', [AppDriverController::class, 'indexVehicle']);     
    Route::get('/service/{id}', [AppDriverController::class, 'getByService']);
    Route::get('/active', action: [AppDriverController::class, 'indexActive']);     
    Route::post('/createVe', [AppDriverController::class, 'storeVehicle']); 
});

//Rutas para aplicacion Conductor
Route::prefix('session-conductor')->group(function () {
    Route::post('/login-password', [AppDriverController::class, 'verificarCredenciales']);
    Route::post('/login', [AppDriverController::class, 'login']);
});
// RUTAS PROTEGIDAS POR AUTH SANCTUM
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::prefix('user')->middleware('auth:sanctum')->controller(UserController::class)->group(function () {
        Route::get('/', 'profile');              
        Route::put('/update', 'update');         
        Route::post('/change-password', 'changePassword'); 
        Route::get('/list', 'index');             
        Route::delete('/delete/{id}', 'destroy'); 
    });


    // Rutas para Drivers
    Route::prefix('driver')->controller(DriverController::class)->group(function () {
        Route::get('/list', 'index');          
        Route::get('/{id}', 'show');           
        Route::put('/update/{id}', 'update');  
        Route::delete('/delete/{id}', 'destroy'); 
        // Otros métodos específicos para drivers
    });

    // Rutas para Riders
    Route::prefix('rider')->controller(RiderController::class)->group(function () {
        Route::get('/list', 'index');       
        Route::get('/{id}', 'show');        
        Route::put('/update/{id}', 'update'); 
        Route::delete('/delete/{id}', 'destroy'); 
        // Otros métodos específicos para riders
    });

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);             
        Route::get('/active', action: [ServiceController::class, 'indexActive']); 
        Route::post('/', [ServiceController::class, 'store']);            
        Route::get('/{id}', [ServiceController::class, 'show']);          
        Route::post('/{id}', [ServiceController::class, 'update']);       
        Route::delete('/{id}', [ServiceController::class, 'destroy']);    
    });

    Route::prefix('service-categories')->group(function () {
        // Rutas específicas primero
        Route::get('/active', [ServiceCategoryController::class, 'getActiveCategories']);
        Route::get('/by-service/{serviceId}', [ServiceCategoryController::class, 'getByServiceId']);

        // Rutas generales después
        Route::get('/', [ServiceCategoryController::class, 'index']);
        Route::post('/', [ServiceCategoryController::class, 'store']);
        Route::post('/{id}', [ServiceCategoryController::class, 'update']);
        Route::delete('/{id}', [ServiceCategoryController::class, 'destroy']);

        // Esta debe ser la última
        Route::get('/{id}', [ServiceCategoryController::class, 'show']);
    });

    Route::prefix('vehicle-types')->group(function () {
        Route::get('/', [VehicleTypeController::class, 'index']);         
        Route::post('/', [VehicleTypeController::class, 'store']);        
        Route::get('/{id}', [VehicleTypeController::class, 'show']);     
        Route::post('/{id}', [VehicleTypeController::class, 'update']);  
        Route::patch('/{id}', [VehicleTypeController::class, 'update']); 
        Route::delete('/{id}', [VehicleTypeController::class, 'destroy']);
        Route::get('/service/{id}', [VehicleTypeController::class, 'getByService']);
        Route::get('/serviceCat/{id}', [VehicleTypeController::class, 'getByServiceCategory']);
    });

    Route::prefix('vehicle-information')->group(function () {
        Route::get('/', [VehicleInformationController::class, 'index']);  
        Route::post('/', [VehicleInformationController::class, 'store']); 
        Route::get('/{id}', [VehicleInformationController::class, 'show']);      
        Route::post('/{id}', [VehicleInformationController::class, 'update']);   
        Route::get('/by-driver/{driver_id}', [VehicleInformationController::class, 'getByDriver']);
        Route::delete('/{id}', [VehicleInformationController::class, 'destroy']); 
    });

    Route::prefix('vehicle-galery')->group(function () {
        Route::get('/', [VehicleGaleryController::class, 'index']);        
        Route::post('/', [VehicleGaleryController::class, 'store']);       
        Route::get('/{id}', [VehicleGaleryController::class, 'show']);     
        Route::post('/{id}', [VehicleGaleryController::class, 'update']);  
        Route::get('/by-driver/{driver_id}', [VehicleGaleryController::class, 'getByDriver']); 
        Route::delete('/{id}', [VehicleGaleryController::class, 'destroy']);
    });

    Route::prefix('zonas')->group(function () {
        Route::get('/', [ZonaController::class, 'index']);   
        Route::post('/', [ZonaController::class, 'store']);  
        Route::get('/{id}', [ZonaController::class, 'show']); 
        Route::post('/{id}', [ZonaController::class, 'update']); 
        Route::delete('/{id}', [ZonaController::class, 'destroy']); 
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);       
        Route::post('/', [SettingController::class, 'store']);      
        Route::get('/{id}', [SettingController::class, 'show']);    
        Route::post('/{id}', [SettingController::class, 'update']); 
        Route::delete('/{id}', [SettingController::class, 'destroy']); 
    });
    //App Indrive Driver

    //App Indrive Rider

    Route::prefix('ride-request')->group(function () {
        Route::get('/', [RideRequestController::class, 'index']);
        Route::post('/', [RideRequestController::class, 'store']);
        Route::get('/{rideRequest}', [RideRequestController::class, 'show']);
        Route::put('/{rideRequest}', [RideRequestController::class, 'update']);
        Route::delete('/{rideRequest}', [RideRequestController::class, 'destroy']);
        Route::post('/{id}/notify-drivers', [RideNotificationController::class, 'notifyNearbyDrivers']);

    });
    Route::prefix('address-rider')->group(function () {
        Route::get('/', [DirectionRiderController::class, 'index']);     
        Route::post('/', [DirectionRiderController::class, 'store']);    
        Route::get('/{id}', [DirectionRiderController::class, 'show']);  
        Route::post('/{id}', [DirectionRiderController::class, 'update']);  
        Route::delete('/{id}', [DirectionRiderController::class, 'destroy']); 
        Route::get('/direction-riders/{id}', [DirectionRiderController::class, 'byRider']);
    });

    Route::prefix('zona')->group(function () {
        Route::post('/check-location', [ZonaController::class, 'checkLocation']);
    });

    Route::prefix('notificationes')->group(function () {
        Route::get('/', [CustomNotificationController::class, 'index']);
        Route::post('/', [CustomNotificationController::class, 'store']);
        Route::delete('/notifications/{id}', [CustomNotificationController::class, 'destroy']);
        // Route::get('/send-notification', [PushNotificationController::class, 'sendPushNotification']);
        Route::post('/send-notification', [PushNotificationController::class, 'enviarNotificaciones']);
    });
});
