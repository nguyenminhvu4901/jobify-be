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
        //Hình thức làm việc
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        //Cấp bậc
        Schema::create('job_levels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        //Kinh nghiệm
        Schema::create('job_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('job_salary_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('job_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('job_salary_type_id')->nullable();
            $table->decimal('from', 15, 4)->nullable();
            $table->decimal('to', 15, 4)->nullable();
            $table->timestamps();
        });

        //Trạng thái tuyển dụng dành cho admin
        Schema::create('approval_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->nestedSet();
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->integer('quantity_recruitment')
                ->comment('Số lượng tuyển')->default(0);
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->date('expiry_date')
                ->comment('Ngày hết hạn')->default(now());
            $table->text('description')
                ->comment('Nội dung tuyển dụng')->nullable();
            $table->text('requirement')
                ->comment('Yêu cầu ứng viên')->nullable();
            $table->text('benefit')
                ->comment('Quyền lợi')->nullable();
            $table->string('working_hour')
                ->comment('Thời gian quyền lợi')->nullable();
            $table->unsignedBigInteger('active_status_id')
                ->comment('Trạng thái tin tuyển dụng dành cho doanh nghiệp')
                ->nullable()
                ->default(1);
            $table->unsignedBigInteger('approval_status_id')
                ->comment('Trạng thái tin tuyển dụng dành cho quản trị viên hệ thống để kiểm duyệt')
                ->nullable()
                ->default(2);
            $table->unsignedBigInteger('job_salary_id')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->unsignedBigInteger('job_level_id')->nullable();
            $table->unsignedBigInteger('job_experience_id')->nullable();
            $table->unsignedBigInteger('view')->default(0);

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('gender_id')->references('id')->on('default_genders')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('active_status_id')->references('id')
                ->on('default_statuses')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('approval_status_id')->references('id')
                ->on('approval_statuses')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('job_salary_id')->references('id')
                ->on('job_salaries')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('job_type_id')->references('id')
                ->on('job_types')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('job_level_id')->references('id')
                ->on('job_levels')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('job_experience_id')->references('id')
                ->on('job_experiences')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();

            $table->softDeletes();
        });

        Schema::create('job_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->text('address')->nullable();

            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('job_position', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();

            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('position_id')->references('id')
                ->on('positions')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('job_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');

            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_levels');
        Schema::dropIfExists('job_experiences');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('job_salary_types');
        Schema::dropIfExists('job_salaries');
        Schema::dropIfExists('approval_statuses');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('job_locations');
        Schema::dropIfExists('job_position');
        Schema::dropIfExists('job_contacts');
    }
};
