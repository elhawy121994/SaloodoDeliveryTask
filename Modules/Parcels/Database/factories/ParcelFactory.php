<?php

namespace Modules\Parcels\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Parcels\Entities\Parcel;
use Modules\Parcels\LookUps\ParcelStatusLookUp;

class ParcelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parcel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'pick_up_address' => $this->faker->address,
            'drop_off_address' => $this->faker->address,
            'sender_id' => 1,
            'status' => ParcelStatusLookUp::READY_FOR_SHIPPING,
            'details' => $this->faker->realText(),
            'notes' => $this->faker->text()
        ];
    }
}

