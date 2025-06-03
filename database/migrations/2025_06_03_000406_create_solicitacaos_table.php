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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('users');
            $table->foreignId('servico_id')->constrained();
            $table->date('data_requerida');
            $table->string('horario');
            $table->string('endereco');
            $table->text('observacoes')->nullable();
            $table->string('metodo_pagamento');
            $table->string('status')->default('pendente'); // pendente, aceito, recusado, cancelado, concluido
            $table->timestamp('data_aceitacao')->nullable();
            $table->timestamp('data_recusacao')->nullable();
            $table->timestamp('data_cancelamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacaos');
    }
};
