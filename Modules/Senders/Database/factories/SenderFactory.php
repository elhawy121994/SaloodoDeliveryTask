<?php
namespace Modules\Senders\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Senders\Entities\Sender;

class SenderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sender::class;

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

