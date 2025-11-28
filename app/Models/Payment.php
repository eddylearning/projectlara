<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'amount',
        'status',
        'method',
        'transaction_id',
        'phone',
        'mpesa_receipt',
        'raw_response',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function logs()
{
    return $this->hasMany(PaymentLog::class);
}

}
