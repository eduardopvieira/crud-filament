<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    public function run(): void
    {
        Tipo::create(['nome' => 'Fritura']);
        Tipo::create(['nome' => 'Assado']);
        Tipo::create(['nome' => 'Receita']);
        Tipo::create(['nome' => 'Puro (In Natura)']);
        Tipo::create(['nome' => 'Industrializado']);
    }
}
