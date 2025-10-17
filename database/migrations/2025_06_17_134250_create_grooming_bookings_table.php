<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grooming_bookings', function (Blueprint $table) {
            $table->id(); // booking id
            $table->string('name');
            $table->string('phone_number');
            $table->date('booking_date');
            $table->string('proof_of_payment')->nullable(); // Path bukti transfer
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending'); // Kolom status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grooming_bookings');
    }
};