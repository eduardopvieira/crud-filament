<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comidas', function (Blueprint $table) {
            $table->index('categoria_id');
            $table->index('tipo_id');
            $table->fullText(['nome', 'descricao']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comidas', function (Blueprint $table) {
             Schema::table('comidas', function (Blueprint $table) {
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['tipo_id']);
            $table->dropFullText(['nome', 'descricao']);
            });
        });
    }
};
