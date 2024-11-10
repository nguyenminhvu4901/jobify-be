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
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_listing_id');
            $table->unsignedBigInteger('application_status_id');
            $table->date('applied_at')->comment('Ngày ứng tuyển');
            $table->text('cover_letter')->nullable()->comment('Thư giới thiệu');
            $table->text('rejection_reason')->nullable()->comment('Lý do từ chối');
            $table->date('hired_at')->nullable()->comment('Ngày được tuyển dụng');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_listing_id')->references('id')->on('job_listings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_status_id')->references('id')->on('application_statuses')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('application_cv', function (Blueprint $table) {
            $table->id();
            $table->string('title', 512);
            $table->text('path');
            $table->unsignedBigInteger('job_application_id');
            $table->timestamps();

            $table->foreign('job_application_id')->references('id')->on('job_applications')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_statuses');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('application_cv');
    }
};
