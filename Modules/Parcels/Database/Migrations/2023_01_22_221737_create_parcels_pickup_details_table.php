<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Parcels\LookUps\ParcelStatusLookUp;

class CreateParcelsPickupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels_pickup_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id');
            $table->foreignId('biker_id');

            $table->timestamp('pick_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcels_pickup_details');
    }
}
