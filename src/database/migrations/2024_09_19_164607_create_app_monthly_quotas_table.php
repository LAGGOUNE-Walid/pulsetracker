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
        Schema::create('app_monthly_quotas', function (Blueprint $table) {
            // $table->engine('TokuDB');
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->integer('messages_sent');
            $table->unsignedBigInteger('app_id');
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_monthly_quotas');
    }
};
