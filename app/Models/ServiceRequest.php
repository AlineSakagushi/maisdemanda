<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests';

    protected $fillable = [
        'client_id',
        'service_id',
        'title',
        'description',
        'expected_budget',
        'desired_date',
        'service_address',
        'preferred_contact',
        'urgency',
        'additional_details',
        'status',
        'request_date',
        'response_date',
        'expiration_date',
    ];

    protected $casts = [
        'expected_budget' => 'decimal:2',
        'desired_date' => 'datetime',
        'request_date' => 'datetime',
        'response_date' => 'datetime',
        'expiration_date' => 'datetime',
        'additional_details' => 'array',
    ];

    // RELATIONSHIPS

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceOrder()
    {
        return $this->hasOne(ServiceOrder::class);
    }

    public function proposals()
    {
        return $this->hasMany(ServiceProposal::class);
    }

    // SCOPES

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['open', 'in_negotiation']);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', now());
    }

    // HELPER METHODS

    public function isExpired()
    {
        return $this->expiration_date && $this->expiration_date->isPast();
    }

    public function canBeAccepted()
    {
        return $this->status === 'open' && !$this->isExpired();
    }
}
