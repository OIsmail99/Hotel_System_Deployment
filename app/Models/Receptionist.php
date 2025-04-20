<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Receptionist extends Model
{

    use SoftDeletes;
    use HasFactory;


    public function created_by(): MorphTo
    {
        return $this->morphTo();
    }

    public function client(): MorphMany
    {
        return $this->morphMany(Client::class, 'created_by');
    }

    public function reservations(): MorphMany
    {
        return $this->morphMany(Reservation::class, 'created_by');
    }
}
