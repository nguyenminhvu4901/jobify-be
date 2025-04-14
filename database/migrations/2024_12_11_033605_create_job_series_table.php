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

        Schema::create('job_age_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('min_age')->nullable();
            $table->unsignedTinyInteger('max_age')->nullable();
            $table->timestamps();
        });

        Schema::create('job_education_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();

            $table->string('title');
            $table->string('slug')->unique();

            $table->integer('quantity_recruitment')->default(0)->comment('Số lượng tuyển');
            $table->foreignId('gender_id')->nullable()->constrained('default_genders')->nullOnDelete()->cascadeOnUpdate();

            $table->date('publish_date')->default(now())->comment('Ngày tuyển dụng');
            $table->date('expiry_date')->default(now())->comment('Ngày hết hạn');

            $table->foreignId('active_status_id')->nullable()->default(1)->constrained('default_statuses')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('approval_status_id')->nullable()->default(2)->constrained('approval_statuses')->nullOnDelete()->cascadeOnUpdate();

            $table->unsignedTinyInteger('min_age')->nullable();
            $table->unsignedTinyInteger('max_age')->nullable();

            $table->foreignId('job_age_range_id')->nullable()->constrained('job_age_ranges')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_education_level_id')->nullable()->constrained('job_education_levels')->nullOnDelete()->cascadeOnUpdate();

            $table->foreignId('job_salary_id')->nullable()->constrained('job_salaries')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_type_id')->nullable()->constrained('job_types')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_level_id')->nullable()->constrained('job_levels')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_experience_id')->nullable()->constrained('job_experiences')->nullOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('view')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->fullText(['title', 'slug']);
        });

        Schema::create('job_listing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')
                ->constrained('job_listings')
                ->cascadeOnDelete();

            $table->text('description')->nullable()
                ->comment('Nội dung tuyển dụng');
            $table->text('requirement')->nullable()
                ->comment('Yêu cầu ứng viên');
            $table->text('income')->nullable()
                ->comment('Thu nhập');
            $table->text('benefit')->nullable()
                ->comment('Quyền lợi');
            $table->string('working_hour')->nullable()
                ->comment('Thời gian làm việc');

            $table->timestamps();
        });

        Schema::create('job_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->string('branch_name')->nullable();
            $table->text('address')->nullable();

            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                 ->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });

        Schema::create('job_position', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_listing_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();

            $table->foreign('job_listing_id')->references('id')
                ->on('job_listings')
                 ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('position_id')->references('id')
                ->on('positions')
                 ->nullOnDelete()->cascadeOnUpdate();

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
                 ->nullOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('job_age_ranges');
        Schema::dropIfExists('job_education_levels');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('job_listing_details');
        Schema::dropIfExists('job_locations');
        Schema::dropIfExists('job_position');
        Schema::dropIfExists('job_contacts');
    }
};
