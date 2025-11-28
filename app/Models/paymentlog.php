<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'type',
        'status_code',
        'status_message',
        'raw_request',
        'raw_response',
    ];

    protected $casts = [
        'raw_request' => 'array',
        'raw_response' => 'array',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
