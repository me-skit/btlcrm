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
            $table->foreignId('status_id')->constrained();
            $table->string('first_name', 64);
            $table->string('second_name', 64)->nullable();
            $table->string('third_name', 64)->nullable();
            $table->string('first_surname', 64);
            $table->string('second_surname', 64)->nullable();
            $table->date('birthday');
            $table->string('e_mail')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('diseases')->nullable();
            $table->string('handicaps')->nullable();
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
