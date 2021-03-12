<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empresa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->company,
            'email' =>$this->faker->unique()->email,
            'logo' => $this->faker->imageUrl($width = 640, $height = 480),// 'http://lorempixel.com/640/480/',
            'website'=> $this->faker->domainName,
        ];
    }
}
