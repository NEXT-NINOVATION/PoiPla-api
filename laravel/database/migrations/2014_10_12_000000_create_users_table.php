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
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger("costume_id")
                ->nullable()
                ->default(null);
            $table->integer("level")->default(1);
            $table->integer("exp")->default(0);
            $table->integer("point")->default(0);
            $table->integer("total_pet")->default(0);
            $table->string('name')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists("users");
    }
};
