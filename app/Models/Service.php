<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'service_category_id',
        'price',
        'estimated_duration',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'estimated_duration' => 'integer',
    ];

    // 🔗 RELACIONAMENTOS

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function orders()
    {
        return $this->hasMany(ServiceOrder::class);
    }

    // 📦 SCOPES

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // 🚦 MÉTODOS AUXILIARES

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function formattedPrice()
    {
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }

    public function formattedDuration()
    {
        if ($this->estimated_duration) {
            $hours = floor($this->estimated_duration / 60);
            $minutes = $this->estimated_duration % 60;
            return ($hours ? "{$hours}h " : '') . ($minutes ? "{$minutes}min" : '');
        }
        return 'Não informado';
    }
}
