<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => "admin",
            'email' => "admin@mahbubalamevan.com",
            'email_verified_at' => now(),
            'password' => \bcrypt('admin'),
            'remember_token' => Str::random(10),
        ];
    }
}
