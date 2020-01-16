<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXuLySuCosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xulysucos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('idhoadon')->unsigned();
            $table->longText('mieuta');
            $table->timestamps();

            $table->foreign('idhoadon')
            ->references('id')->on('phieuorders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xu_ly_su_cos');
    }
}
