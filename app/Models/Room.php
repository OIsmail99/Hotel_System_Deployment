<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'name',
        'number',
        'capacity',
        'price',
        'floor_id',
        'created_by_id',
        'created_by_type',
    ];
    
    protected $appends = ['price_in_dollars'];
    
    protected $with = ['created_by', 'floor'];
    
    // Calculate price in dollars
    public function getPriceInDollarsAttribute()
    {
        return $this->price / 100;
    }
    
    public function created_by(): MorphTo
    {
        return $this->morphTo();
    }

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}