<?php

namespace Database\Factories;

use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => 1,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->tollFreePhoneNumber,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'province_state' => $this->faker->state,
            'country' => $this->faker->country,
            'note' => $this->faker->text($maxNbChars = 250),
            'isClient' => false,
            'isClaimable' => true,
            'assigned' => 4,
            'date_assigned' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
