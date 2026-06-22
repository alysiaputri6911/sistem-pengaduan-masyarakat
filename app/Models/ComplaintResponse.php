<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'responder_name',
        'responder_role',
        'message',
        'attachment',
        'is_final'
    ];

    public function complaint()
    {
        return $this->belongsTo(
            Complaint::class
        );
    }
}