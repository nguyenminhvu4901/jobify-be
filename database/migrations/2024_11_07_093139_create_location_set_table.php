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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('province_name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->integer('province_id');
            $table->integer('code');
            $table->string('district_name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id');
            $table->integer('code');
            $table->string('ward_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('wards');
    }
};
