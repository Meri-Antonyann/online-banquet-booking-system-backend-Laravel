<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'email',
        'number',
        'guests',
        'dateTo',
        'event',
        'service',
        'price',
        'message',
        'status',
        'user_id'

    ];

    public function user () {
        return $this->belongsTo(User::class , 'user_id' );
    }

    public function remarks () {
        return $this->hasMany(RemarkMessage::class   );
    }

}
