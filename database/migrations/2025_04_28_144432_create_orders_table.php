<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id_order', 15)->primary(); // ORD-YYMMNNN
            $table->string('id_pelanggan', 9);
            $table->unsignedBigInteger('id_pricelist');
            $table->string('status')->default('request');
            $table->string('gmaps')->nullable();
            $table->date('tanggal_pembersihan');
            $table->time('waktu_pembersihan');
            $table->timestamps();
        
            // Perbaikan nama foreign key dan referensi
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_pricelist')->references('id')->on('layanans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}

