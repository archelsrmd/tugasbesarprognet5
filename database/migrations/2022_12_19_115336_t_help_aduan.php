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
        
        Schema::create('t_help_aduan', function (Blueprint $table) {
            $table->id();
            $table->integer('pengadu_id')->nullable();
            $table->string('jenis_aduan_id')->nullable();
            $table->string('nomor')->nullable();
            $table->datetime('tanggal')->nullable();
            $table->string('aduan')->nullable();
            $table->string('aduan_foto')->nullable();
            $table->string('status_close')->nullable();
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
