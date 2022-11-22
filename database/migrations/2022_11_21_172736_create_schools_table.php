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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('google_rating')->default(0);
            $table->string('address')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            $table->integer('number')->default(0);
            $table->double('lat')->default(0);
            $table->double('lon')->default(0);
            $table->string('website')->nullable();
            $table->string('men_id')->nullable();
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
        Schema::dropIfExists('schools');
    }
};
