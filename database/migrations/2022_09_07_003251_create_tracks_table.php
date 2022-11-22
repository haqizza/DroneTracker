<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('drone_id');
            $table->foreign('drone_id')->on('drones')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('security_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tea_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('code_id');
            $table->foreign('code_id')->on('codes')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->double('altitude')->nullable();
            $table->double('g_roll')->nullable();
            $table->double('g_pitch')->nullable();
            $table->double('haversine')->nullable();
            $table->double('total_haversine')->nullable();
            $table->double('total_duration')->nullable();
            $table->float('rad')->nullable();
            $table->double('speed')->nullable();
            $table->float('arus')->nullable();
            $table->float('daya')->nullable();
            $table->float('tegangan')->nullable();
            $table->float('ax')->nullable();
            $table->float('ay')->nullable();
            $table->float('az')->nullable();
            $table->float('gx')->nullable();
            $table->float('gy')->nullable();
            $table->float('gz')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
};
