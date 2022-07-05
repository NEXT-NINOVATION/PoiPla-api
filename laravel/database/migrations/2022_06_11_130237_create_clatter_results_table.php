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
        Schema::create("clatter_results", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("session_id");
            $table->unsignedBigInteger("costume_id")->nullable();
            $table->integer("earn_exp")->default(0);
            $table->timestamps();

            $table
                ->foreign("costume_id")
                ->references("id")
                ->on("costumes");
            $table
                ->foreign("session_id")
                ->references("id")
                ->on("sessions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("clatter_results");
    }
};
