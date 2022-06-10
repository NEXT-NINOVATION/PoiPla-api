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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('costume_id')->default(0);
            $table->integer('level')->default(1);
            $table->integer('exp')->default(0);
            $table->integer('point')->default(0);
            $table->integer('total_pet')->default(0);
            $table->timestamps();

            // $table->foreign('costume_id')->references('id')->on('costume');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
