<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id', // To track who made the reply
        'reply',
        'parent_id', // For nested replies
    ];

    // Relationship to the parent reply (for nested replies)
    public function parent()
    {
        return $this->belongsTo(CauseReply::class, 'parent_id');
    }

    // Relationship to child replies
    public function children()
    {
        return $this->hasMany(CauseReply::class, 'parent_id');
    }

    // Relationship to the comment
    public function comment()
    {
        return $this->belongsTo(CauseComment::class);
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
