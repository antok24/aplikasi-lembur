<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRekomendasiToTlembur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tlembur', function (Blueprint $table) {
            $table->string('rekomendasi')->after('kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tlembur', function (Blueprint $table) {
            $table->dropColumn('rekomendasi');
        });
    }
}
