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
        Schema::create('cidadaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf', 14)->unique();
            $table->enum('status', ['Aprovado', 'Em análise', 'Rejeitado', 'Pendente'])->default('Pendente');
            $table->text('mensagem')->nullable();
            $table->date('data_cadastro');
            $table->date('data_pagamento')->nullable();
            $table->decimal('valor_beneficio', 10, 2)->default(600.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cidadaos');
    }
};
