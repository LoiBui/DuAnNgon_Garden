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
            $table->timestamps();
            $table->dateTime('thoigiantao')->default(\Carbon\Carbon::now());
            $table->decimal('tongtien', 15, 0)->default(0);
            $table->foreign('idban')->references('id')->on('bans')->onDelete('cascade');
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
