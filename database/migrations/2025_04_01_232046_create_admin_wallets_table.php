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
        Schema::create('admin_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('solana_address')->default('not available');
            $table->string('bitcoin_address')->default('not available');
            $table->string('ethereum_address')->default('not available');
            $table->string('usdt_address')->default('not available');
            $table->string('polygon_address')->default('not available');
            $table->string('ripple_address')->default('not available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_wallets');
    }
};
