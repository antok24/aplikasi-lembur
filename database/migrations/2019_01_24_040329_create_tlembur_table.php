<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTlemburTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlembur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->date('tgl_lembur');
            $table->text('kegiatan');
            $table->string('volume');
            $table->time('masuk');
            $table->time('pulang');
            $table->string('kode_upbjj');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlembur');
    }
}
