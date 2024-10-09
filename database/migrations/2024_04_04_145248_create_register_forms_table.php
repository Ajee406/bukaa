<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->tinyInteger('enable_batch')->default(ACTIVE);
            $table->tinyInteger('enable_department')->default(ACTIVE);
            $table->tinyInteger('enable_passing_year')->default(ACTIVE);
            $table->tinyInteger('enable_role_number')->default(ACTIVE);
            $table->tinyInteger('enable_attachment')->default(ACTIVE);
            $table->tinyInteger('enable_date_of_birth')->default(ACTIVE);
            $table->tinyInteger('enable_gender')->default(ACTIVE);
            $table->longText('custom_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_forms');
    }
};
