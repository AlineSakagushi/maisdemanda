<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'service_orders';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'service_request_id',
        'professional_id',
        'created_at_custom',
        'status',
        'final_amount',
    ];

    // Se quiser tratar created_at_custom como data
    protected $casts = [
        'created_at_custom' => 'datetime',
        'final_amount' => 'decimal:2',
    ];

    /**
     * Relação com o pedido de serviço (ServiceRequest)
     */
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     * Relação com o profissional (usuário)
     */
    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    /**
     * Relação com a avaliação (uma ordem de serviço pode ter uma avaliação)
     */
    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'service_order_id');
    }
}
