<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolyosImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolyos_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('portfolyo_id')->unsigned();
            $table->string('image');
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreign('portfolyo_id')
                ->references('id')
                ->on('portfolyos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('portfolyos_images');
    }
}
