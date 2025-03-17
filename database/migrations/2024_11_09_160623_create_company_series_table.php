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

        Schema::create('company_working_days', function (Blueprint $table) {
            $table->id();
            $table->string('working_day');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_scale_id')->nullable();
            $table->unsignedBigInteger('company_working_day_id')->nullable();
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
                 ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('company_scale_id')->references('id')->on('company_scales')
                 ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('company_working_day_id')->references('id')
                ->on('company_working_days')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('gender_id')->references('id')->on('default_genders')
                 ->nullOnDelete()->cascadeOnUpdate();
        });

        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });

        Schema::create('company_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('benefit_name');
            $table->string('description');
            $table->foreign('company_id')->references('id')->on('companies')
                ->nullOnDelete()->cascadeOnUpdate();

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
                 ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('operation_type_id')->references('id')->on('operation_types')
                 ->nullOnDelete()->cascadeOnUpdate();
        });

        Schema::create('company_business_sector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('business_sector_id')->nullable();

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                 ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('business_sector_id')->references('id')->on('business_sectors')
                 ->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_scales');
        Schema::dropIfExists('company_working_days');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_branches');
        Schema::dropIfExists('company_benefits');
        Schema::dropIfExists('operation_types');
        Schema::dropIfExists('business_sectors');
        Schema::dropIfExists('company_operation_type');
        Schema::dropIfExists('company_business_sector');
    }
};
