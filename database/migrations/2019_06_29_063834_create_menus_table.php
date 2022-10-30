<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('url')->nullable();
          $table->string('icon')->nullable();
          $table->integer('ordinal')->nullable();
          $table->string('parent_status', 1)->default('N')->nullable();
          $table->integer('parent_id')->unsigned()->nullable();
          $table->integer('permission_id')->unsigned()->nullable();
          $table->timestamps();
          $table->foreign('permission_id')->references('id')->on('permissions');
          $table->foreign('parent_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
