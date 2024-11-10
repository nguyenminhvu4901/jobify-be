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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('position', 512)->comment('Chức vụ');
            $table->unsignedBigInteger('gender_id');
            $table->date('birth_date');
            $table->text('description')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gender_id')->references('id')->on('default_genders');
        });

        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên trường');
            $table->string('major', 512)->comment('Ngành học');
            $table->date('from_date')->comment('Ngày bắt đầu');
            $table->date('to_date')->nullable()->comment('Ngày kết thúc');
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('user_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên sản phẩm');
            $table->string('category', 512)->comment('Thể loại');
            $table->date('finished_date')->comment('Thời gian hoàn thành');
            $table->text('description')->nullable()->comment('Mô tả chi tiết');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('user_product_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_product_id');
            $table->string('title', 512)->comment('Tiêu đề');
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('user_product_id')->references('id')->on('user_products');
            $table->foreign('content_type_id')->references('id')->on('default_content_types');

            $table->timestamps();
        });

        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên kỹ năng');
            $table->unsignedBigInteger('rate_id')->default('1');
            $table->text('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rate_id')->references('id')->on('default_rates')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên chứng chỉ');
            $table->string('organization', 512)->nullable()->comment('Tổ chức');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->unsignedTinyInteger('type')
                ->comment('1: Chứng chỉ, 2:Giải thưởng, 3:Khóa học');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_certification_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_certification_id');
            $table->string('title', 512)->comment('Tiêu đề');
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('user_certification_id')->references('id')->on('user_certifications')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('content_type_id')->references('id')->on('default_content_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên công ty');
            $table->string('position', 512)->comment('Tên chức vụ');
            $table->date('from_date')->comment('Ngày bắt đầu');
            $table->date('to_date')->nullable()->comment('Ngày kết thúc');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('user_experience_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_experience_id');
            $table->string('title', 512)->comment('Tiêu đề');
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('user_experience_id')->references('id')->on('user_experiences')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('content_type_id')->references('id')->on('default_content_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên sản phẩm');
            $table->string('position', 512)->comment('Vị trí tham gia');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->text('description')->nullable()->comment('Mô tả chi tiết');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_activity_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_activity_id');
            $table->string('title', 512)->comment('Tiêu đề');
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('user_activity_id')->references('id')->on('user_activities')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('content_type_id')->references('id')->on('default_content_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 512)->comment('Tên dự án');
            $table->string('client', 512)->comment('Khách hàng');
            $table->unsignedInteger('member')->default(0)->comment('Số thành viên tham gia');
            $table->string('position', 512)->comment('Vị trí');
            $table->string('mission', 512)->comment('Nhiệm vụ trong dự án');
            $table->string('technology', 512)->nullable()->comment('Công nghệ sử dụng');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->text('description')->nullable()->comment('Mô tả chi tiết');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_project_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_project_id');
            $table->string('title', 512)->comment('Tiêu đề');
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('content_type_id');

            $table->foreign('user_project_id')->references('id')->on('user_projects')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('content_type_id')->references('id')->on('default_content_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id')->comment('Tỉnh, thành phố');
            $table->unsignedBigInteger('district_id')->comment('Quận, huyện');
            $table->unsignedBigInteger('ward_id')->comment('Phường, xã');
            $table->string('address', 512)->nullable()->comment('Địa chỉ');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('province_id')->references('id')->on('provinces');
//            $table->foreign('district_id')->references('id')->on('districts');
//            $table->foreign('ward_id')->references('id')->on('wards');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('user_educations');
        Schema::dropIfExists('user_products');
        Schema::dropIfExists('user_product_resources');
        Schema::dropIfExists('user_skills');
        Schema::dropIfExists('user_certifications');
        Schema::dropIfExists('user_certification_resources');
        Schema::dropIfExists('user_experiences');
        Schema::dropIfExists('user_experience_resources');
        Schema::dropIfExists('user_activities');
        Schema::dropIfExists('user_activity_resources');
        Schema::dropIfExists('user_projects');
        Schema::dropIfExists('user_project_resources');
        Schema::dropIfExists('user_locations');
    }
};
