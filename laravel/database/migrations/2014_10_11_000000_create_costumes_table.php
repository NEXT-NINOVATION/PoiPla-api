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
        Schema::create("costumes", function (Blueprint $table) {
            $table->id();
            $table->string("costume_name", 20);
            $table->integer("rarity")->default(1);
            $table
                ->float("rate")
                ->nullable()
                ->default(null);
            $table
                ->integer("req_lv")
                ->nullable()
                ->default(null);
            $table
                ->unsignedBigInteger("pref_id")
                ->nullable()
                ->default(null);
            $table
                ->unsignedBigInteger("event_id")
                ->nullable()
                ->default(null);

            $table
                ->foreign("pref_id")
                ->references("id")
                ->on("prefectures");
            $table
                ->foreign("event_id")
                ->references("id")
                ->on("events");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("costumes");
    }
};
