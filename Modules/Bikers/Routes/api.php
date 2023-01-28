<?php

use Modules\Bikers\Http\Controllers\BikersController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1/bikers')->middleware(['middleware' => 'jwt.verify'])->group(function() {
    Route::middleware(['biker.verify'])->get('parcels', [BikersController::class, 'listParcelForPick'])->name('biker.parcels');
    Route::middleware(['biker.verify'])->patch('parcels/pick/{parcel_id}', [BikersController::class, 'pickParcel'])->name('biker.parcel.pick');
    Route::middleware(['biker.verify'])->patch('parcels/drop-off/{parcel_id}', [BikersController::class, 'dropOffParcel'])->name('biker.parcel.dropOff');
});