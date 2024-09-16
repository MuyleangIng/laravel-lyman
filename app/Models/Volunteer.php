<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    // Add the user_id to the fillable properties
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'photo',
        'address',
        'date_of_birth',
        'profession',
        'skills',
        'experience',
        'education',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'website',
        'github',
        'volunteer_interest',
        'availability',
        'previous_volunteering_experience',
        'detail',
        'cv_file',
        'languages_spoken',
        'emergency_contact',
        'status',
    ];
}
