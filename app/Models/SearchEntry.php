<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchEntry extends Model
{
    use HasFactory;

    protected $fillable = ['query'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}