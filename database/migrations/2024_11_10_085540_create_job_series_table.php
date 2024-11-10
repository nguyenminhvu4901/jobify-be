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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->nestedSet();
            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->timestamps();
        });

        Schema::create('job_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->tinyInteger('type')->comment('1: Thỏa thuận, 2:Từ, 3:Đến');
            $table->unsignedBigInteger('from')->nullable();
            $table->unsignedBigInteger('to')->nullable();

            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')
                ->comment('1: Toàn thời gian, 2:Bán thời gian, 3:Thực tập');
            $table->timestamps();
        });

        Schema::create('job_levels', function (Blueprint $table) {
            $table->id();
            $table->string('title', 512)->comment('Cấp bậc');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('job_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Kinh nghiệm');
            $table->timestamps();
        });

        Schema::create('approval_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->comment('Trạng thái bài đăng');
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('title', 512)->comment('Tiêu đề công việc');
            $table->string('slug', 512);
            $table->unsignedInteger('quantity_recruitment')->default(0)
                ->comment('Số lượng tuyển');
            $table->unsignedBigInteger('gender_id');
            $table->date('expiry_date')->comment('Ngày hết hạn');
            $table->longText('description')->comment('Nội dung ứng viên');
            $table->longText('requirement')->comment('Yêu cầu ứng viên');
            $table->longText('benefit')->comment('Quyền lợi');
            $table->string('working_hour')->comment('Thời gian làm việc');
            $table->unsignedBigInteger('active_status_id')->default(1);
            $table->unsignedBigInteger('approval_status_id')->default(1);
            $table->unsignedBigInteger('job_salary_id')->comment('Mức lương');
            $table->unsignedBigInteger('job_type_id')->comment('Hình thức làm việc');
            $table->unsignedBigInteger('job_level_id')->comment('Cấp bậc');
            $table->unsignedBigInteger('job_experience_id')->comment('Kinh nghiệm');
            $table->unsignedBigInteger('view')->default(0);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('gender_id')->references('id')->on('default_genders');

            $table->foreign('active_status_id')->references('id')->on('default_statuses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('approval_status_id')->references('id')->on('approval_statuses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_salary_id')->references('id')->on('job_salaries')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_type_id')->references('id')->on('job_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_level_id')->references('id')->on('job_levels')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_experience_id')->references('id')->on('job_experiences')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('job_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id');
            $table->unsignedBigInteger('province_id')->comment('Tỉnh, thành phố');
            $table->unsignedBigInteger('district_id')->comment('Quận, huyện');
            $table->unsignedBigInteger('ward_id')->comment('Phường, xã');
            $table->string('address', 512)->nullable()->comment('Địa chỉ');
            $table->timestamps();

            $table->foreign('job_listing_id')->references('id')->on('job_listings')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('job_position', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id');
            $table->unsignedBigInteger('position_id');

            $table->timestamps();

            $table->foreign('job_listing_id')->references('id')->on('job_listings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('position_id')->references('id')->on('positions')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('job_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id');
            $table->string('full_name', 512);
            $table->string('email', 512);
            $table->string('phone_number', 512);

            $table->foreign('job_listing_id')->references('id')->on('job_listings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('job_salaries');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_levels');
        Schema::dropIfExists('job_experiences');
        Schema::dropIfExists('approval_statuses');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('job_locations');
        Schema::dropIfExists('job_position');
        Schema::dropIfExists('job_contacts');
    }
};
