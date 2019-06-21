<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThucDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thucdons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('ten');
            $table->string('giatien');
            $table->integer('loai');
            $table->longText('anh');
            $table->longText('ghichu');
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
        Schema::dropIfExists('thuc_dons');
    }
}
