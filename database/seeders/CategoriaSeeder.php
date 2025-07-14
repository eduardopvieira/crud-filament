<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['nome' => 'Carne']);
        Categoria::create(['nome' => 'Doce']);
        Categoria::create(['nome' => 'Fruta']);
        Categoria::create(['nome' => 'Bebida']);
        Categoria::create(['nome' => 'Grão']);
        Categoria::create(['nome' => 'Laticínio']);
        Categoria::create(['nome' => 'Legume']);
    }
}