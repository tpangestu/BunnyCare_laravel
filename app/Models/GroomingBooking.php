<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'booking_date',
        'proof_of_payment',
        'proof_public_id',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    // Tambahkan ini jika belum ada atau untuk mencoba
    protected $guarded = []; // Ini akan mengizinkan semua kolom diisi secara massal
}