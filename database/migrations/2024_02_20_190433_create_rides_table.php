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
        Schema::create('rides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('driver_id');
            $table->integer('passenger_id');
            $table->integer('vehicle_id');
            $table->text('start_location')->nullable();//TODO: improve here
            $table->text('end_location')->nullable();//TODO: improve here
            $table->text('distance')->nullable();//TODO: improve here
            $table->text('duration')->nullable(); //TODO: improve here
            $table->datetime('arrived_at')->nullable();
            $table->float('base_fare')->default(0);
            $table->float('distance_fare')->default(0);
            $table->float('total')->default(0);
            $table->enum('payment_status',['pending','paid'])->default('pending');
            $table->enum('status',['pending','accepted','started','finished','cancelled','paid','reviewed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('ride_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('driver_id');
            $table->integer('ride_id');
            $table->integer('rating_score');
            $table->integer('passenger_id');
            $table->text('comment')->nullable();
            $table->enum('calculation_status',['pending','used'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
        Schema::dropIfExists('ride_ratings');
    }
};
