<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comidas', function (Blueprint $table) {
            DB::statement('ALTER TABLE comidas ADD FULLTEXT INDEX comidas_nome_descricao_fulltext_index (nome, descricao)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comidas', function (Blueprint $table) {
            $table->dropIndex('comidas_nome_descricao_fulltext_index');
        });
    }
};
