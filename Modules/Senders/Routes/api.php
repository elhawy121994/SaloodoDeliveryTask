<?php

use Illuminate\Support\Facades\Route;
use Modules\Senders\Http\Controllers\SendersController;

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
Route::prefix('v1/senders')->middleware(['middleware' => 'jwt.verify'])->group(function () {
    Route::middleware(['sender.verify'])->get('parcels',
        [SendersController::class, 'listParcel'])->name('sender.parcels');
    Route::middleware(['sender.verify'])->get('parcels/{parcelId}',
        [SendersController::class, 'showSenderParcel'])->name('sender.parcel.show');
});
