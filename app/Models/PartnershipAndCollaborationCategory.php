<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipAndCollaborationCategory extends Model
{
    use HasFactory;

    // protected $table = 'partnerships_and_collaborations';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
    ];

    // Define the relationship with the Cause model
    public function causes()
    {
        return $this->belongsToMany(Cause::class, 'cause_partnerships_and_collaborations');
    }
}
