<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    // Tambahkan properti $fillable ini
    protected $fillable = [
        'name',
        'phone_number',
        'start_date',
        'end_date',
        'total_price', // Ini juga perlu di-fillable
        'proof_of_payment',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}