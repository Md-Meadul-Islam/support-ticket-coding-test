<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
}
