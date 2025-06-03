<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'categoria_id',
        'prestador_id',
        'valor_base',
        'localizacao',
        'disponibilidade'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function prestador()
    {
        return $this->belongsTo(User::class, 'prestador_id');
    }
}