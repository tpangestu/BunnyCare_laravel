<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom proof_public_id ke tabel grooming_bookings
        Schema::table('grooming_bookings', function (Blueprint $table) {
            $table->string('proof_public_id')->nullable()->after('proof_of_payment');
        });

        // Tambah kolom proof_public_id ke tabel clinic_bookings
        Schema::table('clinic_bookings', function (Blueprint $table) {
            $table->string('proof_public_id')->nullable()->after('proof_of_payment');
        });

        // Tambah kolom proof_public_id ke tabel hotel_bookings
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->string('proof_public_id')->nullable()->after('proof_of_payment');
        });
    }

    public function down(): void
    {
        Schema::table('grooming_bookings', function (Blueprint $table) {
            $table->dropColumn('proof_public_id');
        });

        Schema::table('clinic_bookings', function (Blueprint $table) {
            $table->dropColumn('proof_public_id');
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropColumn('proof_public_id');
        });
    }
};