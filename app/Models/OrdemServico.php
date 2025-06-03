<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitacao_id',
        'tecnico_id',
        'data_agendada',
        'horario_agendado',
        'observacoes',
        'valor_final',
        'status',
        'data_inicio',
        'data_conclusao',
        'data_cancelamento'
    ];

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}