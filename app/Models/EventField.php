<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventField extends Model
{
    protected $fillable = ['event_id', 'label', 'type', 'options'];

    protected $casts = [
        'options' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
