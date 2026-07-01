<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'complaints';

    /**
     * Mass Assignment
     */
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

    /**
     * Casting Data
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi Complaint -> User
     * Satu pengaduan dimiliki satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Complaint -> ComplaintResponse
     * Satu pengaduan memiliki banyak respon
     */
    public function responses()
    {
        return $this->hasMany(
            ComplaintResponse::class
        );
    }

    /**
     * Badge warna Bootstrap untuk status
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {

            'open' => 'secondary',

            'in_review' => 'warning',

            'in_progress' => 'primary',

            'resolved' => 'success',

            'closed' => 'dark',

            default => 'secondary'
        };
    }

    /**
     * Badge warna Bootstrap untuk prioritas
     */
    public function getPriorityBadgeAttribute()
    {
        return match ($this->priority) {

            'low' => 'success',

            'medium' => 'warning',

            'high' => 'danger',

            'critical' => 'dark',

            default => 'secondary'
        };
    }

    /**
     * Format status agar lebih rapi
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {

            'open' => 'Dibuka',

            'in_review' => 'Ditinjau',

            'in_progress' => 'Diproses',

            'resolved' => 'Selesai',

            'closed' => 'Ditutup',

            default => $this->status
        };
    }

    /**
     * Format prioritas agar lebih rapi
     */
    public function getPriorityLabelAttribute()
    {
        return match ($this->priority) {

            'low' => 'Rendah',

            'medium' => 'Sedang',

            'high' => 'Tinggi',

            'critical' => 'Kritis',

            default => $this->priority
        };
    }
}