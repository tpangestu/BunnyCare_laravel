<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable(); // Path foto
            $table->decimal('price', 10, 2)->nullable(); // Harga, bisa null untuk hotel
            $table->text('description')->nullable();
            $table->enum('type', ['grooming', 'clinic', 'hotel']); // Tipe layanan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};