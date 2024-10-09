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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('image')->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedBigInteger('campaign_category_id');
            $table->unsignedBigInteger('goal')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('deadline')->nullable();
            $table->longText('details');
            $table->decimal('minimum_amount', 12)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->softDeletes();
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
        Schema::dropIfExists('campaigns');
    }
};
