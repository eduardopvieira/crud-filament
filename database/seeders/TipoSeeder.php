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
        Tipo::create(['nome' => 'Natural']);
        Tipo::create(['nome' => 'Industrializado']);
        Tipo::create(['nome' => 'Congelado']);
        Tipo::create(['nome' => 'Enlatado']);
        Tipo::create(['nome' => 'Desidratado']);
        Tipo::create(['nome' => 'Defumado']);
        Tipo::create(['nome' => 'Fermentado']);
        Tipo::create(['nome' => 'Grelhado']);
        Tipo::create(['nome' => 'Empanado']);
    }
}
