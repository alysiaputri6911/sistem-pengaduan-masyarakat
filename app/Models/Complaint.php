<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $fillable = [
        'user_id',
        'complaint_code',
        'title',
        'description',
        'category',
        'location',
        'attachment',
        'complainant_name',
        'phone',
        'email',
        'priority',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(ComplaintResponse::class)
                    ->latest();
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {

            'pending'   => 'secondary',

            'open'      => 'primary',

            'in_review' => 'warning',

            'in_progress'  => 'info',

            'resolved'  => 'success',

            'closed'    => 'dark',

            default     => 'secondary',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {

            'pending'   => 'Menunggu Admin',

            'open'      => 'Dibuka',

            'in_review' => 'Sedang Direview',

            'in_progress'  => 'Sedang Diproses',

            'resolved'  => 'Selesai',

            'closed'    => 'Ditutup',

            default     => ucfirst($this->status),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | PRIORITY
    |--------------------------------------------------------------------------
    */

    public function getPriorityBadgeAttribute()
    {
        return match ($this->priority) {

            'low'       => 'success',

            'medium'    => 'warning',

            'high'      => 'danger',

            'critical'  => 'dark',

            default     => 'secondary',
        };
    }

    public function getPriorityLabelAttribute()
    {
        return match ($this->priority) {

            'low'       => 'Rendah',

            'medium'    => 'Sedang',

            'high'      => 'Tinggi',

            'critical'  => 'Kritis',

            default     => ucfirst($this->priority),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | PROGRESS BAR
    |--------------------------------------------------------------------------
    */

    public function getProgressAttribute()
    {
        return match ($this->status) {

            'pending'   => 10,

            'open'      => 25,

            'in_review' => 45,

            'in_progress'  => 70,

            'resolved'  => 90,

            'closed'    => 100,

            default     => 0,
        };
    }
}