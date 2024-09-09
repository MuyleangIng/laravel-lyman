<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseTargetRegion extends Model
{
    use HasFactory;

    public function causes()
    {
        return $this->belongsToMany(Cause::class, 'cause_target_regions');
    }
 
}
