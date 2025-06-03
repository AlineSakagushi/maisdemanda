<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'servico_id',
        'data_requerida',
        'horario',
        'endereco',
        'observacoes',
        'metodo_pagamento',
        'status',
        'data_aceitacao',
        'data_recusacao',
        'data_cancelamento'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}