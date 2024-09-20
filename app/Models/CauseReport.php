<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CauseReport extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'cause_id',        
        'user_id',
        'report_type',
        'report_date',
        'report',
        'challenges',
        'solutions',
    ];
    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }
}
