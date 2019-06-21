<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datbans', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('idban')->unsigned();
            $table->date('ngaydat');
            $table->time('giodat');
            $table->string('tenkhachhang');
            $table->string('sdt');
            $table->integer('trangthai');
            $table->timestamps();

            $table->foreign('idban')
            ->references('id')->on('bans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dat_bans');
    }
}
