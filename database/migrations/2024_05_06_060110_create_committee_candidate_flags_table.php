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
        Schema::create('committee_candidate_flags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('committee_category_id')->nullable();
            $table->unsignedBigInteger('committee_election_id')->nullable();
            $table->string('name')->nullable();
            $table->string('flag')->nullable();
            $table->tinyInteger('status')->default(STATUS_PENDING);
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
        Schema::dropIfExists('committee_candidate_flags');
    }
};
