<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::today();
        $now->subYear();

        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('1234'),
            'file_path' => "defaultImage" . rand(20, 30) . ".jpg",
            'role' => "user",
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
