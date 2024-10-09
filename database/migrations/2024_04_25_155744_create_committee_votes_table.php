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
        Schema::create('committee_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('committee_election_id');
            $table->unsignedBigInteger('committee_designation_id');
            $table->unsignedBigInteger('committee_category_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('committee_candidate_id')->nullable();
            $table->string('reason');
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
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
        Schema::dropIfExists('committee_votes');
    }
};
