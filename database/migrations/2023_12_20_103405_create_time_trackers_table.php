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
        Schema::create('time_trackers', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->dateTime('started_at');
            $table->dateTime('stoped_at');
            $table->integer('total_work_minutes');
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_trackers');
    }
};
