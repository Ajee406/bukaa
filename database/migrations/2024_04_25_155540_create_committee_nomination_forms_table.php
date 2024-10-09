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
        Schema::create('committee_nomination_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('committee_election_id');
            $table->unsignedBigInteger('committee_category_id');
            $table->unsignedBigInteger('committee_designation_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->longText('description')->nullable();
            $table->longText('form');
            $table->decimal('amount', 12)->nullable();
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
        Schema::dropIfExists('committee_nomination_forms');
    }
};
