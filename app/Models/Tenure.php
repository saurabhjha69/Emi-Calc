<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenure extends Model
{
    protected $fillable = [
        'months',
        'is_active'
    ];


    public function emirules(): HasMany
    {

        return $this->hasMany(EmiRule::class);
    }
}
