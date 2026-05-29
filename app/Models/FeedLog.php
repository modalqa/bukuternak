<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FeedLog extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['cycle_id', 'user_id', 'date', 'quantity', 'unit', 'cost', 'notes'];

    protected $casts = [
        'date'     => 'date',
        'quantity' => 'decimal:2',
        'cost'     => 'decimal:2',
    ];

    const UPDATED_AT = null;

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
