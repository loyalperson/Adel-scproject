<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'whatsapp', 'payment-method', 'subscription'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function searches()
    {
        return $this->hasMany(SearchEntry::class);
    }

    public function scheduledSearches()
    {
        return $this->hasMany(ScheduledSearch::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favorite::class);
    }
}