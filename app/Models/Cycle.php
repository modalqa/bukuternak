<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasUuids;

    protected $attributes = [
        'status' => 'active',
    ];

    protected $fillable = [
        'user_id', 'name', 'livestock_type', 'start_date', 'end_date',
        'initial_count', 'initial_capital', 'status',
    ];

    protected $casts = [
        'start_date'      => 'date',
        'end_date'        => 'date',
        'initial_capital' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedLogs()
    {
        return $this->hasMany(FeedLog::class)->orderByDesc('date');
    }

    public function mortalityLogs()
    {
        return $this->hasMany(MortalityLog::class)->orderByDesc('date');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class)->orderByDesc('date');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class)->orderByDesc('date');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
