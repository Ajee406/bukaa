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
        Schema::table('committee_elections', function (Blueprint $table) {
            $table->tinyInteger('is_result_done')->after('details')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committee_elections', function (Blueprint $table) {
            $table->dropColumn('is_result_done');
        });
    }
};
