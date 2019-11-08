<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeberapatableToMupbjj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mupbjj', function (Blueprint $table) {
            $table->string('alamat', 150)->after('nama_upbjj');
            $table->string('no_telp', 50)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mupbjj', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('no_telp');
        });
    }
}
