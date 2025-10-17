<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicBooking extends Model
{
    use HasFactory;

    // Tambahkan properti $fillable ini
    protected $fillable = [
        'name',
        'phone_number',
        'booking_date',
        'proof_of_payment',
        'status',
    ];

    // Jika kamu punya field date, Filament DatePicker secara otomatis menanganinya,
    // tapi lebih baik didefinisikan di $casts jika ada manipulasi date
    protected $casts = [
        'booking_date' => 'date',
    ];
}