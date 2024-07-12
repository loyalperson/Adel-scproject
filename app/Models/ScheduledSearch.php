<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'query',
        'frequency',
        'schedule_times',
        'isActive',
    ];

    protected $casts = [
        'schedule_times' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
