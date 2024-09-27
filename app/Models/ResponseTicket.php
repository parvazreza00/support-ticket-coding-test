<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseTicket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ticket() {
        return $this->belongsTo(OpenTicket::class, 'ticket_id', 'id');
    }
    
    public function admin() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
