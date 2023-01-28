<?php

use Illuminate\Support\Facades\Route;
use Modules\Parcels\Http\Controllers\ParcelsController;

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

Route::prefix('v1/parcels')->middleware(['middleware' => 'jwt.verify'])->group(function() {
    Route::post('/', [ParcelsController::class, 'create'])->name('parcel.create');
});