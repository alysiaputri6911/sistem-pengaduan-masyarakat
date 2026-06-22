<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
    'name',
    'email',
    'phone',
    'address',
    'role',
    'password',
];

    /**
     * Kolom yang disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi User -> Complaints
     * Satu user dapat memiliki banyak pengaduan.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah masyarakat.
     */
    public function isCitizen()
    {
        return $this->role === 'citizen';
    }
}