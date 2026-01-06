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
        Schema::create('category_items', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 255);
            $table->timestamps();
        });

        Schema::create('category_item_master_item', function (Blueprint $table) {
            $table->unsignedBigInteger('category_item_id');
            $table->unsignedBigInteger('master_item_id');

            $table->foreign('category_item_id')->references('id')->on('category_items')->onDelete('cascade');
            $table->foreign('master_item_id')->references('id')->on('master_items')->onDelete('cascade');

            $table->primary(['category_item_id', 'master_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_item_master_item');
        Schema::dropIfExists('category_items');
    }
};
