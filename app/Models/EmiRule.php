<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmiRule extends Model
{
    protected $fillable = [
        'min_amount',
        'max_amount',
        'rate_of_interest',
        'tenure_id',
        'is_active',
        'user_id'
    ];


    public function tenure() : BelongsTo {
        return $this->belongsTo(Tenure::class);
    }

    public function createdby(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
