<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    $start = Carbon::parse($this->start_date);
    $end = Carbon::parse($this->end_date);

    $days = $start->diffInDays($end);

    return max(1, $days); // at least 1 day
}

public function calculateTotalAmount()
{
    return $this->calculateDays() * ($this->car->price_per_day ?? 0);
}

}
