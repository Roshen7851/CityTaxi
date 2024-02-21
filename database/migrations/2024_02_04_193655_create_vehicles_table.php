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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->integer('manufactured_year');
            $table->integer('registered_year');
            $table->string('registration_number');
            $table->string('color');
            $table->text('vehicle_license')->nullable();
            $table->text('vehicle_insurance')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
