<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');

            // $table->integer('receptionist_id')->unsigned();
            // $table->foreign('receptionist_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('work_time_id')->unsigned();
            $table->foreign('work_time_id')->references('id')->on('work_times')->onDelete('cascade');

            $table->float('visit_price')->nullable();

            $table->float('visit_paid')->nullable();
            
            $table->date('discount')->nullable();


            $table->date('visit_date')->nullable();

            $table->string('visit_image')->nullable();


            $table->integer('divisions_time_id')->unsigned();
            $table->foreign('divisions_time_id')->references('id')->on('divisions_times')->onDelete('cascade');

            $table->longText('medical_report')->nullable();

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
        Schema::dropIfExists('visits');
    }
}
