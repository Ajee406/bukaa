<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('committee_election_id');
            $table->unsignedBigInteger('committee_designation_id');
            $table->unsignedBigInteger('committee_category_id');
            $table->unsignedBigInteger('committee_nomination_form_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('photo')->nullable();
            $table->text('election_manifesto');
            $table->unsignedBigInteger('flag_id');
            $table->longText('form_data');
            $table->text('reject_reason')->nullable();
            $table->tinyInteger('status')->default(STATUS_PENDING);
            $table->tinyInteger('is_win')->default(STATUS_PENDING);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
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
        Schema::dropIfExists('committee_candidates');
    }
};
