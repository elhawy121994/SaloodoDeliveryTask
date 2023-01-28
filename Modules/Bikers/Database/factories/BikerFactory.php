<?php
namespace Modules\Bikers\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Bikers\Entities\Biker;

class BikerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Biker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}

