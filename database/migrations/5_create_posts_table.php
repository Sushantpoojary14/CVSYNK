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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',100);
            $table->bigInteger('state_id');
            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onDelete('cascade');
            $table->bigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->string('job_title',150);
            $table->text('job_description');
            $table->text('job_requirement');
            $table->bigInteger('job_category_id');
            $table->foreign('job_category_id')
                ->references('id')->on('job_categories')
                ->onDelete('cascade');
            $table->string('posted_date')->default(date('Y-m-d'));
            $table->bigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
