<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MortalityLog extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['cycle_id', 'user_id', 'date', 'count', 'cause', 'notes'];

    protected $casts = [
        'date' => 'date',
    ];

    const UPDATED_AT = null;

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
