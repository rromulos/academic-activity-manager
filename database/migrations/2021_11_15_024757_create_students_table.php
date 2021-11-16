<?php

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
            $table->bigIncrements('id');
            $table->string('name',50)->unique()->comment = "Name of the student";
            $table->integer('university_id')->unsigned()->comment = "University Primary Key";
            $table->string('email',100)->nullable()->comment = "Email of the student";
            $table->string('phone',20)->nullable()->comment = "Phone of the student";
            $table->string('status',20)->default('NEW')->comment = "Status of the student";
            $table->string('ra',20)->comment = "Student unique ID provided by university";
            $table->string('password',30)->comment = "Password provided by university";
            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities');
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
