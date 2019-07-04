<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietPhieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieus', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('idphieuorder')->unsigned();
            $table->bigInteger('idmon')->unsigned();
            $table->integer('soluong');
            $table->longText('ghichu');
            $table->integer('trangthai');
            $table->timestamps();

            $table->foreign('idphieuorder')
            ->references('id')->on('phieuorders')->onDelete('cascade');
            $table->foreign('idmon')
            ->references('id')->on('thucdons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_phieus');
    }
}
