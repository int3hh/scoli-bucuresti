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
        Schema::create('school_results', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->foreignId('school_id');
            $table->integer('students');
            $table->decimal('avg', 4, 2);
            $table->integer('over_nine');
            $table->decimal('percent_over_nine', 5, 2);
            $table->integer('missing');
            $table->decimal('var', 5, 2)->default(0);
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
        Schema::dropIfExists('school_results');
    }
};
