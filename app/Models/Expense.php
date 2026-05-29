<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['cycle_id', 'user_id', 'date', 'category', 'amount', 'notes'];

    protected $casts = [
        'date'   => 'date',
        'amount' => 'decimal:2',
    ];

    const UPDATED_AT = null;

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
