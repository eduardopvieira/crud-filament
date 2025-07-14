<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tenta encontrar o usuário pelo e-mail.
        // Se não encontrar, cria com os dados fornecidos.
        User::firstOrCreate(
            [
                'email' => 'admin@admin.com'
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'), // Criptografa a senha 'admin'
            ]
        );
    }
}