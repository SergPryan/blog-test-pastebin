<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastebinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastebins', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('access',['public','unlisted','private']);
            $table->enum('language',['java','php']);
            $table->dateTime('term');
            $table->string('url')->nullable();
            $table->string('name');
            $table->string('text',524288);
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastebins');
    }
}
