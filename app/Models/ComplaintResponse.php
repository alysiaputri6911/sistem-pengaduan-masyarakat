<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintResponse extends Model
{
    protected $fillable = [
        'complaint_id',
        'responder_name',
        'responder_role',
        'message',
        'attachment',
        'is_final',
    ];

    protected $casts = [
        'is_final' => 'boolean',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}