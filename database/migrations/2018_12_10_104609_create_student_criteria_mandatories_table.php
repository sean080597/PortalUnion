<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCriteriaMandatoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_criteria_mandatories', function (Blueprint $table) {
            $table->char('student_id', 10);
            $table->integer('criteria_id')->unsigned();
            $table->string('self_assessment', 30);
            $table->tinyInteger('mark_student')->unsigned()->default('0');
            $table->tinyInteger('mark_classroom')->unsigned()->default('0');
            $table->tinyInteger('mark_faculty')->unsigned()->default('0');
            $table->tinyInteger('mark_school')->unsigned()->default('0');
            $table->primary(array('student_id', 'criteria_id'));
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('criteria_id')->references('id')->on('criteria_mandatories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('student_criteria_mandatories');
    }
}
