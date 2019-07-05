<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('idphieu')->unsigned();
            $table->dateTime('thoigiantao')->default(\Carbon\Carbon::now());
            $table->string('tongtien');
            $table->integer('trangthai');
            $table->timestamps();
            
            $table->foreign('idphieu')
            ->references('id')->on('phieuorders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_dons');
    }
}
