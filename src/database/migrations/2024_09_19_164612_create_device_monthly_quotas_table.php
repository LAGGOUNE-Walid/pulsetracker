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
        Schema::create('device_monthly_quotas', function (Blueprint $table) {
            // $table->engine('TokuDB');
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->integer('messages_sent');
            $table->unsignedBigInteger('device_id');
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_monthly_quotas');
    }
};
