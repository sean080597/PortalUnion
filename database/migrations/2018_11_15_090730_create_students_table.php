<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->char('id', 10);
            $table->string('name', 50);
            $table->string('address', 100)->nullable();
            $table->string('image')->nullable();
            $table->boolean('sex')->default('0');
            $table->date('birthday')->nullable();
            $table->string('hometown', 30)->nullable();
            $table->string('ethnic', 20)->nullable();
            $table->string('religion', 20)->nullable();
            $table->date('union_date')->nullable();
            $table->boolean('is_submit')->default('0');
            $table->primary('id');
            $table->string('class_room_id', 10);
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('students');
    }
}
