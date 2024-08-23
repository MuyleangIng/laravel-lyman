<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'name',
        'photo',
        'reply',
    ];

    /**
     * Get the comment that owns the reply.
     */
    public function comment()
    {
        return $this->belongsTo(CauseComment::class, 'comment_id');
    }
}

