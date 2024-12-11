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
        //Quy mô công ty
        Schema::create('company_scales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_scale_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('tax_code');
            $table->text('website')->nullable();
            $table->text('description')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('company_scale_id')->references('id')->on('company_scales')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('default_genders')
                ->onDelete('set null')->onUpdate('cascade');
        });

        Schema::create('company_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });

        //Loại hình hoạt động
        Schema::create('operation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();
        });

        //Lĩnh vực hoạt động
        Schema::create('business_sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->timestamps();
        });

        Schema::create('company_operation_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('operation_type_id')->nullable();

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('operation_type_id')->references('id')->on('operation_types')
                ->onDelete('set null')->onUpdate('cascade');
        });

        Schema::create('company_business_sector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('business_sector_id')->nullable();

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('business_sector_id')->references('id')->on('business_sectors')
                ->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('operation_types');
        Schema::dropIfExists('business_sectors');
        Schema::dropIfExists('company_operation_type');
        Schema::dropIfExists('company_business_sector');
    }
};
