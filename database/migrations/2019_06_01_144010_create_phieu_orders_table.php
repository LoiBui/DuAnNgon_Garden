<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieuorders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('idban')->unsigned();
            $table->bigInteger('idnhanvien')->unsigned();
            $table->timestamps();
            $table->dateTime('thoigiantao')->default(\Carbon\Carbon::now());

            $table->foreign('idban')->references('id')->on('bans')->onDelete('cascade');
            
            $table->foreign('idnhanvien')->references('id')->on('taikhoans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_orders');
    }
}
