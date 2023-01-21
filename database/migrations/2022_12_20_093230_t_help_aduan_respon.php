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
        Schema::create('t_help_aduan_respon', function (Blueprint $table) {
            $table->id();
            $table->integer('aduan_id')->nullable();
            $table->integer('pengadu_id')->nullable();
            $table->integer('pegawai_id')->nullable();
            $table->datetime('tanggal')->nullable();
            $table->string('respon')->nullable();
            $table->string('respon_foto')->nullable();
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
        //
    }
};
