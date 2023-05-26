<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateDataMeteranPelangganTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('datameteranpelanggan',function(Blueprint $table){
            $table->increments("id");
            $table->string("nama");
            $table->string("no_meteran");
            $table->string("start_meteran");
            $table->text("catatan")->nullable();
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
        Schema::drop('datameteranpelanggan');
    }

}