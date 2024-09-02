<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausePartnershipAndCollaboration extends Model
{
    use HasFactory;

    // The table associated with the model.
protected $table = 'cause_partnerships_and_collaborations';

    // The attributes that are mass assignable.
    protected $fillable = [
        'cause_id',
        'partnership_id',
    ];

    // Define the relationship with the Cause model
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    // Define the relationship with the PartnershipAndCollaborationCategory model
    public function partnership()
    {
        return $this->belongsTo(PartnershipAndCollaborationCategory::class, 'partnership_id');
    }
}
