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
        Schema::create('affiliate_user_account', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique()->nullable();
            $table->string('referral_code')->unique()->nullable();
            $table->string('withdraw')->default(0)->nullable();
            $table->string('total_earnings')->default(0)->nullable();
            $table->string('balance')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_user_account');
    }
};
