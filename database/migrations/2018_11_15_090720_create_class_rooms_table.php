<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('faculty_id', 4);
            $table->integer('uid_secretary')->unsigned()->nullable();
            $table->integer('uid_deputysecre1')->unsigned()->nullable();
            $table->integer('uid_deputysecre2')->unsigned()->nullable();
            $table->primary('id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('uid_secretary')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('uid_deputysecre1')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('uid_deputysecre2')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('class_rooms');
    }
}
