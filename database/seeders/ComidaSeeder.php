<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comida;

class ComidaSeeder extends Seeder
{
    public function run(): void
    {
        Comida::factory(50)->create();
    }
}
