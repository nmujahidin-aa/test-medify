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
        if(!Schema::hasColumn('master_items', 'images')) {
            Schema::table('master_items', function (Blueprint $table) {
                $table->string('images')->nullable()->after('nama');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_items', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
