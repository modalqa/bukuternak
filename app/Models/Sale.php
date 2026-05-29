<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'cycle_id', 'user_id', 'date', 'quantity', 'quantity_unit',
        'total_price', 'buyer_name', 'notes',
    ];

    protected $casts = [
        'date'        => 'date',
        'quantity'    => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    const UPDATED_AT = null;

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
