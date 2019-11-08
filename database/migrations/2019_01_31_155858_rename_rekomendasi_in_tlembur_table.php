<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRekomendasiInTlemburTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tlembur', function (Blueprint $table) {
            $table->renameColumn('rekomendasi','satuan');
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
            $table->renameColumn('satuan','rekomendasi');
        });
    }
}
