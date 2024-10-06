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
        Schema::create('device_last_locations', function (Blueprint $table) {
            // $table->engine('TokuDB');

            $table->id();
            $table->ipAddress('ip_address');
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('user_id');
            $table->string('device_key');
            $table->string('app_key');
            // $table->geometry('location', subtype: 'point');
            $table->json('location');
            $table->json('extra_data')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');

            $table->index('user_id');
            $table->index('app_id');
            $table->index('device_id');
            $table->index(['device_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_last_locations');
    }
};
