<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_units', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('category_id');
            $table->integer('jumlah_awal');
            $table->string('satuan_awal');
            $table->integer('jumlah_akhir');
            $table->string('satuan_akhir');
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
        Schema::dropIfExists('information_units');
    }
}
