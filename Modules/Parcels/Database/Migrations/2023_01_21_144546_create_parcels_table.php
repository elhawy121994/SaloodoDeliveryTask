<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Parcels\LookUps\ParcelStatusLookUp;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pick_up_address');
            $table->string('drop_off_address');
            $table->foreignId('sender_id');
            $table->enum('status', [
                ParcelStatusLookUp::READY_FOR_SHIPPING,
                ParcelStatusLookUp::SHIPPED,
                ParcelStatusLookUp::DELIVERED,
                ParcelStatusLookUp::CANCELED
            ])->default( ParcelStatusLookUp::READY_FOR_SHIPPING);
            $table->string('details')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcels');
    }
}
