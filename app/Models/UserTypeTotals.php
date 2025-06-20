<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTypeTotals extends Model
{
    protected $table = 'user_type_totals';

  
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

 
    protected $fillable = [
        'total_clients',
        'total_professionals',
    ];
}
