<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->comment = "Type of activity";
            $table->integer('student_id')->unsigned()->comment = "Student Primary Key";
            $table->integer('subject_id')->unsigned()->comment = "Subject Primary Key";
            $table->string('delivery_date',10)->comment = "Delivery Date of the activity";
            $table->text('observation')->nullable()->comment = "Observation of the activity";
            $table->decimal('price',10,2)->nullable()->comment = "Price of the activity";
            $table->string('status',20)->default(config('status.status.AGUARDANDO'))->comment = "Status of the activity";
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
        Schema::dropIfExists('activities');
    }
}
