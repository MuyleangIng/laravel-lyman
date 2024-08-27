<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseComment extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the default
    protected $table = 'cause_comments';

    // Define the fillable attributes
    protected $fillable = [
        'cause_id',
        'user_id', // To track who made the comment
        'message',
    ];

    // Define the relationship to the Cause model
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    // Define the relationship to the CauseReply model
    public function replies()
    {
        return $this->hasMany(CauseReply::class, 'comment_id')->whereNull('parent_id');
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

