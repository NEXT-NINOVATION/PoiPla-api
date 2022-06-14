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
        Schema::create("my_costumes", function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("costume_id");
            $table->timestamps();

            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users");
            $table
                ->foreign("costume_id")
                ->references("id")
                ->on("costumes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("my_costumes");
    }
};
