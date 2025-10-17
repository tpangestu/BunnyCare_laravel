<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_information', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('instagram')->nullable();
            $table->text('address')->nullable();
            $table->text('map_embed_code')->nullable(); // Untuk kode embed peta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_information');
    }
};
