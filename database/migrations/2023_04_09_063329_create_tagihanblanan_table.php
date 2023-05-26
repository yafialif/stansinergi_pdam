<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateTagihanBlananTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('tagihanblanan',function(Blueprint $table){
            $table->increments("id");
            $table->integer("datameteranpelanggan_id")->references("id")->on("datameteranpelanggan");
            $table->string("awal_meteran");
            $table->string("akhir_meteran");
            $table->string("total_pemakaian");
            $table->string("harga");
            $table->string("total_tagihan_bulan_ini");
            $table->string("tunggakan_sebelumnya");
            $table->string("diskon")->nullable();
            $table->string("total_tagihan")->nullable();
            $table->string("status_tagihan");
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
        Schema::drop('tagihanblanan');
    }

}