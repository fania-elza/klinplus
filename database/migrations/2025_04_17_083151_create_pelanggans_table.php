<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->string('id_pelanggan', 9)->primary(); // Format CS + YYMM + 000 (3 digit)
            $table->string('nama_pelanggan', 100);
            $table->string('nomor_telepon', 15)->unique(); // Tambahkan unique
            $table->string('email', 100)->nullable()->unique(); // Tambahkan unique
            $table->string('alamat')->nullable()->change();
            $table->string('kota', 100)->nullable();
            $table->string('gmaps', 500)->nullable(); // Ubah dari text ke string dengan limit
            $table->text('patokan')->nullable();
            $table->timestamps();
            
            // Tambahkan index untuk pencarian
            $table->index('nama_pelanggan');
            $table->index('kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
