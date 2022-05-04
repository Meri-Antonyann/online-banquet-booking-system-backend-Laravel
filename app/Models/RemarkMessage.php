<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id',
        'receiver_id',
        'booking_id',
    ];
    public function booking () {
        return $this->belongsTo(Booking::class, 'booking_id'  );
    }
}
