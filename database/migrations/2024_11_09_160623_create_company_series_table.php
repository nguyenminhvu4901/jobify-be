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
        Schema::create('company_scales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_scale_id');
            $table->unsignedBigInteger('gender_id');
            $table->string('name');
            $table->string('slug');
            $table->string('tax_code');
            $table->text('website')->nullable();
            $table->text('description')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_scale_id')->references('id')->on('company_scales')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('default_genders')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('company_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_scales');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_address');
    }
};
