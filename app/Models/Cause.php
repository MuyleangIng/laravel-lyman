<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cause extends Model
{

    use HasFactory;
    use Sluggable;

    protected $guarded = [];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function targetAudiences()
    {
        return $this->belongsToMany(TargetAudienceCategory::class, 'cause_target_audiences', 'cause_id', 'target_audience_category_id');
    }

    public function partnershipsAndCollaborations()
    {
        return $this->belongsToMany(PartnershipAndCollaborationCategory::class, 'cause_partnerships_and_collaborations', 'cause_id', 'partnership_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function targetRegions()
    {
        return $this->belongsToMany(TargetRegion::class, 'cause_target_regions');
    }

    public function reports()
    {
        return $this->hasMany(CauseReport::class);
    }
    
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'cause_user_likes')->withTimestamps();
    }


    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'cause_user_bookmarks')->withTimestamps();
    }

}
