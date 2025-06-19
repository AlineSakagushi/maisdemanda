<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardGrowth extends Model
{

    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'dashboard_growth';

   
    protected $primaryKey = null;

    
    protected $fillable = [
        'total_mes_atual',
        'total_mes_anterior',
        'crescimento_percentual',
        'total_available_balance',
    ];
}
