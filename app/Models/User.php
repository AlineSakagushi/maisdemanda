<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Garante que utiliza a tabela correta

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_type',
        'description',
        'rating_average',
        'total_ratings',
        'profile_photo',
        'document',
        'birth_date',
        'gender',
        'status',
        'available_balance',
        'available_for_work',
        'working_hours',
        'hourly_rate',
        'city',
        'state',
        'specialization',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'available_balance' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
        'rating_average' => 'decimal:2',
        'available_for_work' => 'boolean',
    ];

    // RELATIONSHIPS

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function primaryAddress()
    {
        return $this->hasOne(Address::class)->where('type', 'primary');
    }

    public function serviceRequestsAsClient()
    {
        return $this->hasMany(ServiceRequest::class, 'client_id');
    }

    public function serviceOrdersAsClient()
    {
        return $this->hasMany(ServiceOrder::class, 'client_id');
    }

    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'client_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'professional_id');
    }

    public function serviceOrdersAsProfessional()
    {
        return $this->hasMany(ServiceOrder::class, 'professional_id');
    }

    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'professional_id');
    }

    public function serviceLocations()
    {
        return $this->hasMany(ServiceLocation::class, 'professional_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // HELPER METHODS

    public function isClient()
    {
        return $this->user_type === 'Client';
    }

    public function isProfessional()
    {
        return $this->user_type === 'Professional';
    }

    public function isAdmin()
    {
        return $this->user_type === 'Admin';
    }

    public function getAverageRating()
    {
        return $this->ratingsReceived()->avg('rating') ?: 0;
    }

    public function getTotalRatings()
    {
        return $this->ratingsReceived()->count();
    }
}
