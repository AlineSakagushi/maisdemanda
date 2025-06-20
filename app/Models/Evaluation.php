<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';

    protected $fillable = [
        'service_order_id',
        'client_id',
        'professional_id',
        'service_id',
        'rating',
        'comment',
        'evaluation_criteria',
        'evaluation_date',
        'professional_response',
        'response_date',
        'status',
    ];

    protected $casts = [
        'evaluation_criteria' => 'array',
        'evaluation_date' => 'datetime',
        'response_date' => 'datetime',
        'rating' => 'decimal:1',
    ];

    /**
     * Relacionamento com a ordem de serviço.
     */
    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    /**
     * Relacionamento com o cliente (usuário).
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Relacionamento com o profissional (usuário).
     */
    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    /**
     * Relacionamento com o serviço.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
