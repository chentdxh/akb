<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("fid");
            $table->string("name");
            $table->string("path",2040);
            $table->string("mime_type")->nullable();
            $table->integer("width")->default(0);
            $table->integer("height")->default(0);
            $table->integer("size")->default(0);
            $table->string("hash",127)->nullable();

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
        Schema::dropIfExists('file_infos');
    }
}
