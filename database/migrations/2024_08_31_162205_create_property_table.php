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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->integer('capacity');
            $table->integer('bedroom');
            $table->boolean('has_kitchen');
            $table->boolean('has_bathroom');
            $table->boolean('has_laundry_area');
            $table->boolean('has_living_room');
            $table->boolean('has_lobby');
            $table->boolean('has_parking');
            $table->boolean('has_yard');
            $table->boolean('has_balcony');
            $table->boolean('has_terrace');
            $table->boolean('has_cctv');
            $table->boolean('has_electric_meter');
            $table->boolean('has_water_meter');
            $table->boolean('has_advance_payment');
            $table->boolean('has_security_deposit');
            $table->boolean('is_gated');
            $table->string('curfew_hour');
            $table->decimal('price');
            $table->string('address');
            $table->string('lingitude');
            $table->string('latitude');
            $table->date('available_at');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
