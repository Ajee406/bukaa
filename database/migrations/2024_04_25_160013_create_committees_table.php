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
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('committee_election_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('committee_designation_id');
            $table->unsignedBigInteger('committee_category_id');
            $table->unsignedBigInteger('photo')->nullable();
            $table->string('company')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('committees');
    }
};
