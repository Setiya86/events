<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'event_date'];
    
    protected $casts = [
        'event_date' => 'datetime',
    ];


    public function fields()
    {
        return $this->hasMany(EventField::class);
    }

    public function submissions()
    {
        return $this->hasMany(EventSubmission::class);
    }
}

