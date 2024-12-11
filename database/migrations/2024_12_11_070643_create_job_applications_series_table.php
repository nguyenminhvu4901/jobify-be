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
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->comment('Người ứng tuyển')->nullable();
            $table->unsignedBigInteger('job_listing_id')
                ->comment('Công việc')->nullable();
            $table->unsignedBigInteger('application_status_id')
                ->comment('Trạng thái ứng tuyển')->nullable();
            $table->date('applied_at')->comment('Ngày ứng tuyển')->default(now());
            $table->text('cover_letter')->comment('Thư giới thiệu đến nhà tuyển dụng')->nullable();
            $table->text('rejection_reason')->comment('Lý do từ chối')->nullable();
            $table->date('hired_at')->comment('Ngày được ứng tuyển')->nullable();

            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('application_status_id')->references('id')
                ->on('application_statuses')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('application_cv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id')->nullable();
            $table->string('title');
            $table->text('path');

            $table->foreign('job_application_id')->references('id')
                ->on('job_applications')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
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
