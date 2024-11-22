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
        Schema::table('manga', function (Blueprint $table) {
            $table->dropColumn('category_name');
            $table->dropColumn('category_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manga', function (Blueprint $table) {
            $table->string('category_name')->nullable();
            $table->string('category_description')->nullable();
        });
    }
};
