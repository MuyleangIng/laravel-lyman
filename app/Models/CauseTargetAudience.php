<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseTargetAudience extends Model
{
    use HasFactory;

    // The table associated with the model.
    // protected $table = 'cause_target_audience';

    // The attributes that are mass assignable.
    protected $fillable = [
        'cause_id',
        'target_audience_category_id',
    ];

    // Define the relationships with the Cause and TargetAudienceCategory models
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    public function targetAudienceCategory()
    {
        return $this->belongsTo(TargetAudienceCategory::class, 'target_audience_category_id');
    }
}
