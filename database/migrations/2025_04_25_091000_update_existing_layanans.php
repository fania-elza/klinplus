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
        //
        DB::table('layanans')
        ->whereNull('id_pricelist')
        ->update(['id_pricelist' => '']);

    // Then modify the column to be non-nullable
    Schema::table('layanans', function (Blueprint $table) {
        $table->string('id_pricelist', 50)->nullable(false)->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};


