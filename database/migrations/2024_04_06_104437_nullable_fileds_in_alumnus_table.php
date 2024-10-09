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
        Schema::table('alumnus', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id')->nullable()->change();
            $table->unsignedBigInteger('department_id')->nullable()->change();
            $table->unsignedBigInteger('passing_year_id')->nullable()->change();
            $table->string('id_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnus', function (Blueprint $table) {
            //
        });
    }
};
