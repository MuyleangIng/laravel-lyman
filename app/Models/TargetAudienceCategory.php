<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetAudienceCategory extends Model
{
    use HasFactory;

    protected $table = 'target_audience_categories';

    protected $fillable = [
        'name',
    ];
}
