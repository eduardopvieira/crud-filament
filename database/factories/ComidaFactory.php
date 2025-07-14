<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
use App\Models\Tipo;
use Illuminate\Support\Str;

class ComidaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => Str::ucfirst(fake('pt_BR')->words(2, true)),
            'descricao' => fake()->sentence(),
            'preco' => fake()->randomFloat(2, 5, 100),
            'quantidade' => fake()->numberBetween(10, 200),
            'modo-de-preparo' => fake()->randomElement(['frito', 'assado', 'cozido', 'natural', 'industrializado', 'nao_aplica']),

            'categoria_id' => Categoria::inRandomOrder()->first()->id,
            'tipo_id' => Tipo::inRandomOrder()->first()->id,
        ];
    }
}