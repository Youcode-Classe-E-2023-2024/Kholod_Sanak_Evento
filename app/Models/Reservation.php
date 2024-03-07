<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'email',
        ];

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

}
