<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that can be mass-assigned.
     * (important for create() in your controller)
     */
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Status constants — optional but cleaner
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Relationships
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //for payment calc
    public function payment()
{
    return $this->hasOne(Payment::class);
}

public function calculateDays()
{
    return now()->parse($this->start_date)->diffInDays($this->end_date);
}

public function calculateTotalAmount()
{
    return $this->calculateDays() * $this->car->price; // car price per day
}

}
