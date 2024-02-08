<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->id();
            $table->char('valor');
        });


        // TODO: Mudar pra constantes ou seeders 
        DB::table('tipo_usuario')->insert([
            ['valor' => 'administrador'],
            ['valor' => 'costureira'],
        ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_usuario');
    }
};
