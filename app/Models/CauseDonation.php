<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseDonation extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'cause_id',
        'user_id',
        'price',
        'currency',
        'payment_id',
        'payment_method',
        'payment_status',
    ];

    // Relationship to the Cause model
    public function cause()
    {
        return $this->belongsTo(Cause::class, 'cause_id');
    }

    // Relationship to the User model (donor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

