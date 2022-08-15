<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 64);
            $table->string('second_name', 64)->nullable();
            $table->string('third_name', 64)->nullable();
            $table->string('first_surname', 64);
            $table->string('second_surname', 64)->nullable();
            $table->string('sex', 1);
            $table->tinyInteger('status');
            $table->date('birthday');
            $table->date('death_date')->nullable();
            $table->string('e_mail', 128)->nullable();
            $table->string('cellphone', 32)->nullable();
            $table->text('diseases')->nullable();
            $table->text('handicaps')->nullable();
            $table->text('preferences')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('people');
    }
}
