<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitacao_id')->constrained()->onDelete('cascade');
            $table->foreignId('prestador_id')->constrained('users')->onDelete('cascade');
            $table->decimal('valor_proposto', 10, 2);
            $table->text('descricao');
            $table->date('data_prevista');
            $table->string('status')->default('pendente'); // pendente, aceito, recusado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_proposals');
    }
};