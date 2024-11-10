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
            $table->string('name', 512);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên công ty');
            $table->string('slug', 512);
            $table->unsignedBigInteger('company_scale_id');
            $table->unsignedBigInteger('gender_id');
            $table->text('website')->nullable();
            $table->text('description')->nullable();
            $table->string('tax_code')->comment('Mã số thuế');
            $table->text('avatar')->nullable();
            $table->timestamps();

            $table->foreign('company_scale_id')->references('id')->on('company_scales')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('company_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('province_id')->comment('Tỉnh, thành phố');
            $table->unsignedBigInteger('district_id')->comment('Quận, huyện');
            $table->unsignedBigInteger('ward_id')->comment('Phường, xã');
            $table->string('address', 512)->nullable()->comment('Địa chỉ');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('operation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('company_operation_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('operation_type_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('operation_type_id')->references('id')->on('operation_types')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('business_sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('company_business_sector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('business_sector_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('business_sector_id')->references('id')->on('company_business_sector')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('company_operation_type');
        Schema::dropIfExists('business_sectors');
        Schema::dropIfExists('company_business_sector');
    }
};
