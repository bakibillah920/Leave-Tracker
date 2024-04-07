<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Application cache has been cleared</h1>';
});

//Optimized class loader:v2.sales.commission.commissionManage-v2
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::middleware('auth')->group(function () {
    Route::any('/{segment1}', [App\Http\Controllers\RoutingController::class, 'panelRequestHandler']);
    Route::any('/{segment1}/{segment2}', [App\Http\Controllers\RoutingController::class, 'panelRequestHandler']);
    Route::any('/{segment1}/{segment2}/{segment3}', [App\Http\Controllers\RoutingController::class, 'panelRequestHandler']);
    Route::any('/{segment1}/{segment2}/{segment3}/{segment4}', [App\Http\Controllers\RoutingController::class, 'panelRequestHandler']);
});
