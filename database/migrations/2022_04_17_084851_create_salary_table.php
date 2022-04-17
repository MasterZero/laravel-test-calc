<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount');
            $table->unsignedSmallInteger('should_work');
            $table->unsignedSmallInteger('actually_work');
            $table->boolean('mzp');
            $table->boolean('pensioner');
            $table->tinyInteger('disability');
            $table->unsignedInteger('year');
            $table->unsignedSmallInteger('month');

            $table->unsignedInteger('work_amount');
            $table->unsignedInteger('personal_fee');
            $table->unsignedInteger('pension_fee');
            $table->unsignedInteger('medicine_fee');
            $table->unsignedInteger('medicine_ensurance');
            $table->unsignedInteger('social_fee');
            $table->unsignedInteger('tax_fee');
            $table->unsignedInteger('correction_fee');
            $table->unsignedInteger('total');

            $table->unique([
                'amount',
                'should_work',
                'actually_work',
                'mzp',
                'pensioner',
                'disability',
                'year','month'
            ], 'amount_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
