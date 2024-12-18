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
        Schema::create('default_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->comment('1: active, 2:deactivate');
            $table->timestamps();
        });

        Schema::create('default_genders', function (Blueprint $table) {
            $table->id();
            $table->string('gender')->comment('1: male, 2:female, 3:other');
            $table->timestamps();
        });

        Schema::create('default_content_types', function (Blueprint $table) {
            $table->id();
            $table->string('content_type')->comment('1:image, 2:file, 3:url, 4:video');
            $table->timestamps();
        });

        Schema::create('default_rates', function (Blueprint $table) {
            $table->id();
            $table->string('rate')->comment('1:1 sao.... 5: 5 sao')->default('1 sao');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('slug')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number');

            $table->unsignedBigInteger('status_id')->nullable()
                ->default(1)->comment('default active');
            $table->string('current_user')->nullable();
            $table->string('avatar')
                ->default(asset(config('constants.default_avatar')));

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_id')->references('id')->on('default_statuses')
                ->onDelete('set null')->onUpdate('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_statuses');
        Schema::dropIfExists('default_genders');
        Schema::dropIfExists('default_content_types');
        Schema::dropIfExists('default_rates');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
